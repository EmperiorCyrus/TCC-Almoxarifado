<?php
  //======================================================================
  // MODEL - NOTA FISCAL
  //======================================================================
  namespace App\Model;                  // Nomeclatura

  use PDO;                              // Usando classes internas do PHP por meio do Namespace
  use PDOException;                     // **
  use Exception;                        // **

  use App\Model\DTO\InvoiceDTO;         // Usando classes próprio do sistema.
  use Core\DataBase;                    // **
  use Utils\write_log;                  // **


  /**
   * Class responsável pela manipulação geral de toda nota-fiscal.
   * Usando sintaxe SQL com o método PDO nas funções de manipulações.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class ModelInvoice {

    private $conn;          // Conexão com o BD



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
     * Function responsável por criar um novo registro de nota-fiscal
     * Ele altera, registra ações relacionada e retorna erros em exceções.
     * 
     * @param InvoiceDTO      - classe que possui dados de nota-fiscal
     * 
     * @return bool|array     - Boa (true) |  má execução (Exceptions)
     */
    public function insert(InvoiceDTO $invoiceDTO): bool {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Montando Query para criar uma nova nota fiscal.
        $insert_query = "INSERT INTO nota (nome, path, descricao) VALUES (:nome, :path, :descricao)";         // Query para inserir dados         
        $insert_stmt = $this->conn->prepare($insert_query);                                                   // Preparando sintaxe SQL
        $insert_stmt->bindParam(':nome',          $invoiceDTO->getName(),                   PDO::PARAM_STR);  // Dando valores aos espaços declarado
        $insert_stmt->bindParam(':path',          $invoiceDTO->getPath(),                   PDO::PARAM_STR);  // **
        $insert_stmt->bindValue(':descricao',     $invoiceDTO->getDescription()   ?? null,  PDO::PARAM_STR);  // **

        // Verifica se a inserção foi bem-sucedida.
        if ($insert_stmt->execute()) {

          $text = "[ CREATE ][ INVOICE ] - [ Nome - {$invoiceDTO->getName()} ]";                              // Salva topicos para log
          $log = write_log::write($text, "register");                                                         // Chamando função para escrever registro
          return true;                                                                                        // Retorna true ao controller indicando sucesso.
        }


      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ INVOICE / CREATE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return $error_pdo;                                                    // Retorna array ao controller com PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ INVOICE / CREATE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Retorna array ao controller com Exception.
      }
    }



    /**
     * Function responsável pela atualização da nota-fiscal.
     * Ele atualiza, registra ações relacionada e retorna erros em exceções.
     * 
     * @param InvoiceDTO - classe que possui dados de nota-fiscal
     * 
     * @return bool|array - Boa (true)| má execução (Exceptions)
     */
    public function update(InvoiceDTO $invoiceDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {
    
        // Query e manilação para atualização de descrição da nota fiscal.
        $update_query = "UPDATE nota SET descricao = :new_description WHERE idnota = :idnota";
        $update_stmt  = $this->conn->prepare($update_query);                                              // Preparando sintaxe SQL
        $update_stmt->bindParam(':idnota',           $invoiceDTO->getIdinvoice(),       PDO::PARAM_INT); // Dando valores aos espaços declarado.
        $update_stmt->bindParam(':new_description',   $invoiceDTO->getDescription(),     PDO::PARAM_STR); // **

        // Verifica se a execução é bem-sucedida.
        if ($update_stmt->execute()) {

          $text = "[ UPDATE ][ INVOICE ] - [ Atualização da descrição de nota: {$invoiceDTO->getIdinvoice()} ]";  // Salva topicos para log
          $log = write_log::write($text, "register");                                                             // Chamando função para registrar log
          return true;
        }
        

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ INVOICE / UPDATE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro no BD no log
        return $error_pdo;                                                    // Retorna erro do PDOException.
      

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system){

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ INVOICE / UPDATE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Retorna erro do Exception.
      }                                           
    }

    

    /**
     * Function responsável por deletar a nota-fiscal.
     * Além de deletar, ele registra ações relacionada a ela.
     * 
     * @param InvoiceDTO      - classe que possui dados de nota-fiscal
     * 
     * @return string|array   - boa execução (Diretorio da nota) | má execução (Exceptions)
     */
    public function delete(InvoiceDTO $invoiceDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        $query = "SELECT idlote FROM lote WHERE idnota = :idnota";                              // Query para verificar se existe algum lote registrado na nota a ser apagado
        $stmt  = $this->conn->prepare($query);                                                  // Preparando sintaxe SQL
        $stmt->bindParam('idnota',     $invoiceDTO->getIdinvoice(),     PDO::PARAM_INT);        // Dando valor ao espaço declarado
        $stmt->execute();                                                                       // Executando sintaxe

        // Verificando se não existe nenhuma resposta
        if ($stmt->rowCount() == 0) {

          // Variaveis reescritas
          $query = "SELECT path FROM nota WHERE idnota = :idnota";                             // Query para obter caminho da nota fiscal
          $stmt  = $this->conn->prepare($query);                                                // Preparando sintaxe SQL
          $stmt->bindParam(':idnota',      $invoiceDTO->getIdinvoice(),      PDO::PARAM_INT);   // Dando valor ao espaço declarado

          // Aproveita o Select anterior para verificar se há nota correspodente ao ID.
          // Verifica se há uma boa execução
          if ($stmt->execute()) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);                                           // Obtendo resultado da query.

            // Montando query para deleção de todos os dados da nota-fiscal referente ao ID.
            $delete_query = "DELETE FROM nota WHERE idnota = :idnota";
            $delete_stmt  = $this->conn->prepare($delete_query);
            $delete_stmt->bindParam(':id_sent',         $invoiceDTO->getIdinvoice(),         PDO::PARAM_INT);

            // Verifica se a execução foi bem-sucedida
            if ($delete_stmt->execute()) { 

              $text =["[ DELETE ][ NOTA-FISCAL ] - [ID: {$invoiceDTO->getIdinvoice()} ]"];    // Salva topicos para log
              $log = write_log::write($text, 'register');                                     // Solicita função para escrever registro.
              return $result['path'];                                                         // Retornando o diretorio da nota
            }
          }
        }
      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {
        
        $text = ["[ BD ][ INVOICE / DELETE ]"];                               // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Solicita função para escrever log em registro.
        return $error_pdo;                                                    // Retorna ao controller de uma má execução com "1".
        

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {
        
        $text = ["[ SYSTEN ]", "[ MODEL ] [ INVOICE / DELETE ]"];             // Salva topicos para log
        $log = write_log::write($text, 'error-system', $error_system);        // Solicita função para escrever log em registro.
        return $error_system;                                                 // Retorna controller de uma má execução com "1".
        
      }  
    }



    /**
     * Function responsável em obter todos os dados de nota-fiscal.
     * 
     * @return array  -  Boa | Má execução
     */
    public function selectAll(): array {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {
        
        $query = "SELECT * FROM nota";                                        // Query para buscar todos os resultados de nota
        $stmt = $this->conn->prepare($query);                                 // Preparando sintaxe SQL

        // Verifica se há uma execução bem-sucedida
        if ($result = $stmt->execute()) {    
            
          $invoices = [];                                                     // Declarando Array para guardar conteudo do SQL 
          while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {   
            
            //instanciando uma nova class (DTO) para passar os parametros
            $content = new InvoiceDTO($result['nome'], $result['path'], $result['descricao'], intval($result['idnota']), $result['data_criacao']);                        
            $invoices[intval($result['idnota'])] = $content;                  // Aramazenando dados e nomeando posição referente ao número do ID
          }

          return $invoices;                                                   // Retornando DTO armazenado
        }

        
      //> Tratativa de erro relacionado ao Banco de Dados.      
      } catch (PDOException $error_pdo) {

        $text = ["[ BD ][ INVOICE / GET INFO ]"];                             // Salva topicos para log.
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Solicita função para escrever log em registro.
        return $error_pdo;                                                    // Retorna para o controller PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ SYSTEN ]", "[ MODEL ] [ INVOICE / GET INFO ]"];           // Salva topicos para log.
        $log = write_log::write($text, 'error-system', $error_system);        // Solicita função para escrever log em registro.
        return $error_system;                                                 // Retorna para o controller Exception.
      }
    }



    public function selectById(InvoiceDTO $invoiceDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {
        $query = "SELECT idnota FROM nota WHERE idnota = :idnota";            // Query para buscar nota relacionado ao ID
        $stmt  = $this->conn->prepare($query);                                // Preparando sintaxe SQL

        // Verifica se há execução bem-sucedida
        if ($stmt->execute()) {

          $result = $stmt->fetch(PDO::FETCH_ASSOC);                           // Obtendo resultado do SQL
          $invoice = new InvoiceDTO($result['nome'], $result['path'], $result['descricao'], intval($result['idnota']), $result['datacricao']);  //instanciando uma nova class (DTO) para passar os parametros

          return $invoice;                                                    // Retornando DTO armazenado.
        }


      //> Tratativa de erro relacionado ao Banco de Dados.      
      } catch (PDOException $error_pdo) {

        $text = ["[ BD ][ INVOICE / GET ID ]"];                               // Salva topicos para log.
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Solicita função para escrever log em registro.
        return $error_pdo;                                                    // Retorna para o controller PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ SYSTEN ]", "[ MODEL ] [ INVOICE / GET ID ]"];             // Salva topicos para log.
        $log = write_log::write($text, 'error-system', $error_system);        // Solicita função para escrever log em registro.
        return $error_system;                                                 // Retorna para o controller Exception.
      }
    }
  }

?>