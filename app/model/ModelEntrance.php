<?php
  //======================================================================
  // MODEL - ENTRADA
  //======================================================================
  namespace App\Model;

  use App\Model\DTO\EntranceDTO;
  use Core\DataBase;
  use PDO;

  use PDOException;
  use Exception;
  use Utils\write_log;
  /**
   * Class responsável pela manipulação geral de toda entrada.
   * Usando sintaxe SQL com o método PDO nas funções de manipulações.
   * 
   * @author Gustavo Cavalcante - Guhghamer@gmail.com
   * @version 1.0
   */
  class ModelEntrance{

    private $conn;                         // Conexão com o BD

    /**
     * Construtor responsável em instanciar a conexão com o BD.
     * Armazenando numa propriedade para futuras reutilização.
     */
    public function __construct() {
      $this->conn = Database::connect();                  // Instancia e guarda Conexão
      if ($this->conn instanceof PDOException) {          // Verifica se houver erro
        throw new PDOException($this->conn);              // Retorna erro da conexão
      } 
    }

    
    /**
     * Function responsável em criar um novo registro de entrada.
     * Ele cria, registra ações relacionada e retorna erros em exceções.
     * 
     * @param EntranceDTO      - classe que possui dados de entranda
     * 
     * @return bool|array     - Boa (true) |  má execução (Exceptions) 
     */
    public function insert(EntranceDTO $entranceDTO) { 
             
      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {
  
        $query = "SELECT idlote FROM lote WHERE idlote = :idlote";                            // Query para identificar ID correspondente ao id do lote passado.
        $stmt = $this->conn->prepare($query);                                                 // Preparando sintaxe SQL.
        $stmt->bindParam(':idlote',      $entranceDTO->getIdBatch(),     PDO::PARAM_INT);     // Dando valor ao espaço declarado.
  
        // Verificando se há execução bem-sucedida.
        if ($stmt->execute()) {
          // verifica se há um ID relacionado.
          if ($stmt->rowCount() == 1) {

          // Query para inserir um novo registro de entrada
          $query_insert = "INSERT FROM entrada (idproduto, idlote, quantidade, validade, valor) VALUE(:idproduto, :idlote, :quantidade, :validade, :valor)";
          $insert_stmt = $this->conn->prepare($query_insert);                                                             // Preparando sintaxe SQL.
          $insert_stmt->bindParam(':idproduto',       $entranceDTO->getIdProduct(),               PDO::PARAM_INT);        // Dando valor ao espaço declarado.
          $insert_stmt->bindParam(':idlote',          $entranceDTO->getIdBatch(),                 PDO::PARAM_INT);        // **
          $insert_stmt->bindParam(':quantidade',      $entranceDTO->getAmount(),                  PDO::PARAM_INT);        // **
          $insert_stmt->bindValue(':validade',        $entranceDTO->getValidity()   ?? null,      PDO::PARAM_STR);        // **
          $insert_stmt->bindValue(':valor',           $entranceDTO->getValue()      ?? null,      PDO::PARAM_STR);        // **
      
          // Verifica se há execução bem-sucedida
          if($insert_stmt->execute()) {
                  
            $text  = "[ CREATE ][ ENTRANCE ] - [ Produto ID: {$entranceDTO->getIdProduct()} do Lote: {$entranceDTO->getIdBatch()} ]";
            $text .= "[ Quantidade: - {$$entranceDTO->getAmount()} ]";                        // Salva topico para log,
            $log = write_log::write($text, "register");                                       // Chama função para registrar tópico.
            return true;                                                                      //
          }          
        }
      }
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ ENTRANCE / CREATE ]"];                  // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return $error_pdo;                                                    // Alerta controller de uma má execução com "1".
  
      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / CREATE ]"];     // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Alerta controller de uma má execução com "1".
      }
      return 0;
    }



    /**
     * Function responsável por alterar o ID relacionado do registro de entrada para o lote.
     * Ele altera, registra ações relacionada e retorna erros em exceções.
     * 
     * @param EntranceDTO      - classe que possui dados de entrada
     * 
     * @return bool|array      - Boa (true)| má execução (Exceptions)
     */
    public function update(EntranceDTO $entranceDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try { 

        $query = "SELECT identrada FROM saida WHERE identrada = :identrada_fk";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam('identrada_fk',      $entranceDTO->getIdEntrance(),    PDO::PARAM_INT);

        // verifica se há execução bem-sucedida
        if ($stmt->execute()) {

          // verifica se não há resgistro do uso de entradas na saida.
          if ($stmt->rowCount() == 0) {
            
            $update_query = "UPDATE entrada SET idlote = :new_idlote WHERE identrada = :identrada";
            $update_stmt  = $this->conn->prepare($update_query);
            $update_stmt->bindParam(':identrada',     $entranceDTO->getIdEntrance(),     PDO::PARAM_INT);
            $update_stmt->bindParam(':new_idlote',    $entranceDTO->getIdBatch(),        PDO::PARAM_INT);


            if ($update_stmt->execute()) {

              $text = "[ UPDATE ][ ENTRANCE ] - [ Atualização da entrada: {$entranceDTO->getIdEntrance()}, Lote ID relacionado: {$entranceDTO->getIdBatch()} ]";  // Salva topicos para log
              $log = write_log::write($text, "register");                                                             // Chamando função para registrar log
              return true;            
            }
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ ENTRANCE / UPDATE ]"];                    // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);                // Chamando função para escrever erro do BD no log
        return $error_pdo;                                                      // Alerta controller de uma má execução com "1".
  
      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / UPDATE ]"];       // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);          // Chamando função para escrever erro de sistema no log
        return $error_system;                                                   // Alerta controller de uma má execução com "1".
      }
    }

    

    /**
     * Function responsável por deletar registro de entrada.
     * Ele deleta, registra ações relacionada e retorna erros em exceções.
     * 
     * @param Entra nceDTO     - classe que possui dados de entrada
     * 
     * @return bool|array      - Boa (true)| má execução (Exceptions)
     */
    public function delete(EntranceDTO $entranceDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        $query = "SELECT identrada FROM saida WHERE identrada = identrada_fk";  // Query para verificar se existe relação entre o ID da entrada a ser apagada com BD "Saida" 
        $stmt  = $this->conn->prepare($query);                                  // Preparando sintaxe SQL.
        $stmt->bindParam(':identrada',      $entranceDTO->getIdEntrance());     // Dando valor ao espaço declarado

        // Verificando se há uma boa execução.
        if ($stmt->execute()) {
  
          // Verificando se não há nenhuna entrada relacionada.
          if ($stmt->rowCount() > 0) {
  
            $delete_query = "DELETE FROM entrada WHERE identrada = :identrada";                               // Query para deletar entrada pelo ID
            $delete_stmt = $this->conn->prepare($delete_query);                                               // Preparando sintaxe SQL
            $delete_stmt->bindParam(':identrada',     $entranceDTO->getIdEntrance(),       PDO::PARAM_INT);   // Dando valor ao espaço declarado

            // Verifica se a execução é bem-sucedida.
            if ($delete_stmt->execute()) {
      
              $text = "[ DELETE ][ ENTRANCE ] - [Entrada ID: {$entranceDTO->getIdEntrance()} ]";              // Salva topicos para log
              $log = write_log::write($text, "register");                                                     // Chamando função para registrar log
              return true;                                                                                    // Retorna true ao controller indicando sucesso.
            }
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){
    
        $text = ["[ ERROR ][ BD ] - [ ENTRANCE / DELETE ]"];                  // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro no BD no log
        return $error_pdo;                                                    // Retorna array ao controller com PDOException error.
      

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system){

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / DELETE ]"];     // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Retorna array ao controller com Exception error.
      }                                  
    }



  public function selectAll() {

    //> Analiza execuções dentro da função de possiveis erros e falha.
    try { 
      // Querys para obter ID da nota antes de ser atualizado
      $query = "SELECT * FROM entrada";
      $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
      
      // Verificando se há execução bem-sucedida
      if ($stmt->execute()) {
  
        $entrances = [];                                                    // Declarando Array para guardar conteudo do SQL 
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
          

          $content = new EntranceDTO($result['idproduto'], $result['idlote'], $result['quantidade'], $result['validade'], $result['valor']);
          $entrances[intval($result['identrada'])] = $content;
        }

        // Colocar LOG de GET ALL.
        return $entrances;
      }


    //> Tratativa de erro relacionado ao Banco de Dados.
    } catch (PDOException $error_pdo){
  
      $text = ["[ ERROR ][ BD ] - [ ENTRANCE - SELECT ALL ]"];                // Salva topicos para log
      $log = write_log::write($text, "error-pdo", $error_pdo);                // Chamando função para escrever erro no BD no log
      return $error_pdo;                                                      // Retorna array ao controller com PDOException error.

    //> Tratativa de erro relacionado ao Sistema.
    } catch (Exception $error_system){

      $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE - SELECT ALL ]"];   // Salva topicos para log
      $log = write_log::write($text, "error-system", $error_system);          // Chamando função para escrever erro de sistema no log
      return $error_system;                                                   // Retorna array ao controller com Exception error.
    }
  }



  public function selectById(EntranceDTO $entranceDTO) {

    //> Analiza execuções dentro da função de possiveis erros e falha.
    try { 

      $query = "SELECT identrada FROM entrada WHERE identrada = :identrada";                   // Query para buscar entrada relacionado ao ID
      $stmt  = $this->conn->prepare($query);                                                   // Preparando sintaxe SQL
      $stmt->bindParam('identrada',       $entranceDTO->getIdEntrance(),    PDO::PARAM_INT);   // Dando valor ao espaço declarado

      // Verifica se há execução bem-sucedida
      if ($stmt->execute()) {

        $result = $stmt->fetch(PDO::FETCH_ASSOC);                             // Obtendo resultado do SQL
        $entrance = new EntranceDTO($result['idproduto'], $result['idlote'], $result['quantidade'], $result['validade'], $result['valor'], $result['identrada']);  // Instanciando Class DTO para salvar dados.

        return $entrance;                                                     // Retornando Array contendo DTO armazenado.
      }

      //> Tratativa de erro relacionado ao Banco de Dados.
    } catch (PDOException $error_pdo){

      $text = ["[ ERROR ][ BD ] - [ ENTRANCE - SELECT BY ID ]"];              // Salva topicos para log
      $log = write_log::write($text, "error-pdo", $error_pdo);                // Chamando função para escrever erro no BD no log
      return $error_pdo;                                                      // Retorna array ao controller com PDOException error.

    //> Tratativa de erro relacionado ao Sistema.
    } catch (Exception $error_system){

      $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE - SELECT BY ID ]"]; // Salva topicos para log
      $log = write_log::write($text, "error-system", $error_system);          // Chamando função para escrever erro de sistema no log
      return $error_system;                                                   // Retorna array ao controller com Exception error.
    }
  }
}


