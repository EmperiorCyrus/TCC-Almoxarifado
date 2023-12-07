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

    static  $att_class_invoice = false; // Status de verificação de propriedade. 
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
     * Function responsável por criar uma nova nota-fiscal
     * Ele cria e registra ações relacionada a nota-fiscal.
     * 
     * @param InvoiceDTO - classe que possui dados de nota-fiscal
     * 
     * @return bool      - Boa ou má execução
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

          self::$att_class_invoice = false;                                                                   // Avisando que a class não está atualizado

          $text = "[ CREATE ][ INVOICE ] - [ Nome - {$invoiceDTO->getName()} ]";                              // Salva topicos para log
          $log = write_log::write($text, "register");                                                         // Chamando função para escrever registro
        }


      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ INVOICE / CREATE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return false;                                                         // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ INVOICE / CREATE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return false;                                                         // Alerta controller de uma má execução com "1".
      }

      // Alerta controller de uma boa execução com ??.
      return true;
    }



    /**
     * Function responsável pela atualização da nota-fiscal.
     * Ele atualiza descrição e registra ações relacionada a nota-fiscal.
     * 
     * @param InvoiceDTO - classe que possui dados de nota-fiscal
     * 
     * @return bool      - Boa ou má execução
     */
    public function update(InvoiceDTO $invoiceDTO): bool {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {
    
        // Querys para obter
        $query = "SELECT data SET descricao id = :id_sent";
        $stmt  = $this->conn->prepare($query);                                                              // Preparando sintaxe SQL.
        $stmt->bindParam(':id_sent',       $invoiceDTO->getIdinvoice(),       PDO::PARAM_INT);              // Dando valores aos espaços declrado.

        // Aproveita o Select anterior para verificar se há nota correspodente ao ID.
        // Verifica se há uma boa execução
        if ($stmt->execute()) {

          // Query e manilação para atualização de descrição da nota fiscal.
          $update_query = "UPDATE nota SET descricao = :new_description WHERE id = :id_sent";
          $update_stmt  = $this->conn->prepare($update_query);                                              // Preparando sintaxe SQL
          $update_stmt->bindParam(':id_sent',           $invoiceDTO->getIdinvoice(),       PDO::PARAM_INT); // Dando valores aos espaços declarado.
          $update_stmt->bindParam(':new_description',   $invoiceDTO->getDescription(),     PDO::PARAM_STR); // **

          // Verifica se a execução é bem-sucedida.
          if ($update_stmt->execute()) {

            $text = "[ UPDATE ][ INVOICE ] - [ Atualização da descrição de nota: {$invoiceDTO->getIdinvoice()} ]";  // Salva topicos para log
            $log = write_log::write($text, "register");                                                             // Chamando função para registrar log            
            self::$att_class_invoice = false;                                                                       // Avisando que a class não está atualizado
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ INVOICE / UPDATE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro no BD no log
        return false;                                                         // Alerta controller de uma má execução com "1".
      

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_systen){

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ INVOICE / UPDATE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_systen);        // Chamando função para escrever erro de sistema no log
        return false;                                                         // Alerta controller de uma má execução com "1".
      }

      // Alerta controller de uma boa execução com "0".
      return true;                                               
    }

    

    /**
     * Function responsável por deletar a nota-fiscal.
     * Além de deletar, ele registra ações relacionada a ela.
     * 
     * @param InvoiceDTO - classe que possui dados de nota-fiscal
     * 
     * @return string|int   $path (boa execução) | 1 (má execução)
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
          $query =  "SELECT path FROM nota WHERE id = :id_sent";                                // Query para obter caminho da nota fiscal
          $stmt  = $this->conn->prepare($query);                                                // Preparando sintaxe SQL
          $stmt->bindParam(':id_sent',      $invoiceDTO->getIdinvoice(),      PDO::PARAM_INT);  // Dando valor ao espaço declarado

          // Aproveita o Select anterior para verificar se há nota correspodente ao ID.
          // Verifica se há uma boa execução
          if ($stmt->execute()) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);                           // Obtendo resultado da query.

            $path = $result['path'];                                            // Armazena caminho do PDF do SELECT anterior
            $date = $result['data'];                                            // Armazena data da nota-fiscal.


            // Montando query para deleção de todos os dados da nota-fiscal referente ao ID.
            $delete_query = "DELETE FROM nota WHERE id = :id_sent";
            $delete_stmt  = $this->conn->prepare($delete_query);
            $delete_stmt->bindParam(':id_sent',           $invoiceDTO->getIdinvoice(),               PDO::PARAM_INT);

            // Verifica se a execução foi bem-sucedida
            if ($delete_stmt->execute()) { 

              self::$att_class_invoice = false;                                 // Avisando que a class não está atualizado

              $text =["[ DELETE ][ NOTA-FISCAL ] - {$date}"];                   // Salva topicos para log
              $log = write_log::write($text, 'register');                       // Solicita função para escrever registro.
            }
          }
        }
      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {
        
        $text = ["[ BD ][ INVOICE / DELETE ]"];                                 // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);                // Solicita função para escrever registro.
        return 1;                                                               // Retorna ao controller de uma má execução com "1".
        

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {
        
        $text = ["[ SYSTEN ]", "[ MODEL ] [ INVOICE / DELETE ]"];               // Salva topicos para log
        $log = write_log::write($text, 'error-system', $error_system);          // Solicita função para escrever registro.
        return 1;                                                               // Retorna controller de uma má execução com "1".
        
      }

      // Retorna caminho do PDF para ser deletado pelo controller.
      return $path;
    }



/**
     * Function responsável em obter todos os dados de nota-fiscal.
     * 
     * @return array|int  -  Boa | Má execução
     */
    public function selectAll(): array
    {
        try {
    
          if (!self::$att_class_invoice) {
  
              $query = "SELECT * FROM nota";
              //exit(var_dump($query));
              $stmt = $this->conn->prepare($query);
  
              if ($result = $stmt->execute()) {    
                  
                  $invoices = [];
                  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {   
                      //exit(var_dump($result));                     
                      $note = new InvoiceDTO($result['nome'], $result['path'], $result['descricao'], intval($result['idnota']), $result['data_criacao']);                        
                      $invoices[intval($result['idnota'])] = $note;
                  }
                  return $invoices;
              }
          }       
        } catch (PDOException $error_pdo) {
    
            $text = ["[ BD ][ INVOICE / GET INFO ]"];
            $log = write_log::write($text, "error-pdo", $error_pdo);
            throw $error_pdo;
    
        } catch (Exception $error_system) {
    
            $text = ["[ SYSTEN ]", "[ MODEL ] [ INVOICE / GET INFO ]"];
            $log = write_log::write($text, 'error-system', $error_system);
            throw $error_system;
        }
        
    }
  }

?>