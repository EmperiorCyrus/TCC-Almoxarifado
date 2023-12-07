<?php
  //======================================================================
  // MODEL - LOTE
  //======================================================================
  namespace App\Model;

  use App\Model\DTO\BatchDTO;
  use Core\DataBase;
  use PDO;

  use PDOException;
  use Exception;
  use Utils\write_log;

  /**
   * Class responsável pela manipulação geral de todo o lote.
   * Usando sintaxe SQL com o método PDO nas funções de manipulações.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class ModelBatch {

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
     * Function responsável em criar um novo lote.
     * Além de criar, ele registra ações relacionada a ela.
     * 
     * @param BatchDTO      - classe que possui dados de lote
     * 
     * @return bool         - Boa ou má execução
     */
    public function insert(BatchDTO $batchDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Query para verificar a existencia da NOTA referente.
        $query = "SELECT idnota FROM nota WHERE idnota = :idnota_fk";                               // Query para identificar ID correspondente na tabela nota.
        $stmt = $this->conn->prepare($query);                                                       // Preparando sintaxe SQL.
        $stmt->bindParam(':idnota_fk',      $batchDTO->getIdInvoice(),     PDO::PARAM_INT);         // Dando valor ao espaço declarado.

        // Verificando se a execução foi bem-sucedida.
        if ($stmt->execute()) { 

          // Verificando se a resposta da query é apenas 1.
          if ($stmt->rowCount() == 1) {

            $insert_query = "INSERT INTO lote(idnota) VALUE (:idnota, :cod)";                       // Query para inserir um novo lote com o ID da nota-fiscal.
            $insert_stmt  = $this->conn->prepare($insert_query);                                    // Preparando sintaxe.
            $insert_stmt->bindParam(':idnota',      $batchDTO->getIdInvoice(),     PDO::PARAM_INT); // Dando valor ao espaço declarado.
            $insert_stmt->bindParam(':cod',         $batchDTO->getCod(),           PDO::PARAM_INT); // **
            
            // Verifica se há uma boa execução
            if ($insert_stmt->execute()) {

              $text = "[ CREATE ][ BATCH ] - [ Lote da Nota-Fiscal ID: {$batchDTO->getIdInvoice()} ]";   // Salva topico para log,
              $log = write_log::write($text, "register");                                                // Chama função para registrar tópico.
            }

          // Em caso de não ter resultado ou ter mais de um.
          } else {

            return 1;
          }
        }



      //> Tratativa de erro relacionado ao Banco de Dados.
      
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ BATCH / CREATE ]"];                     // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return 1;                                                             // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ BATCH / CREATE ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      }

      return 0;
    }
  


    /**
     * Function responsável em atualizar dados de lote.
     * Além de criar, ele registra ações relacionada a ela.
     * 
     * @param BatchDTO      - classe que possui dados de lote
     * 
     * @return bool|array   - Boa ou má execução
     */
    public function update(BatchDTO $batchDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Querys para obter ID da nota antes de ser atualizado
        $query = "SELECT idnota FROM lote WHERE idlote = :idlote";                                          // Query para buscar ID da nota relacionada
        $stmt  = $this->conn->prepare($query);                                                              // Preparando sintaxe SQL
        $stmt->bindParam('idlote',       $batchDTO->getIdBatch(),       PDO::PARAM_INT);                    // Dando valor ao espaço declarado

        // Verificando se há uma boa execução.
        if ($stmt->execute()) {

          $result = $stmt->fetch(PDO::FETCH_ASSOC);                                                         // Obtendo resultado
          $old_id_invoice = $result['idnota'];                                                              // Salvando ID da nota no resultado

          // Query para atualizar o ID da nota relacionada.
          $update_query = "UPDATE lote SET cod = :cod, id_nota = :id_nota WHERE id = :id_sent";             // Query para a atualização de nota e código.

          $update_stmt  = $this->conn->prepare($update_query);                                              // Preparando sintaxe
          $update_stmt->bindParam(':idlote',       $batchDTO->getIdBatch(),                PDO::PARAM_INT); // Dando valores aos espaços declarados
          $update_stmt->bindValue(':cod',          $batchDTO->getCod()         ?? null,    PDO::PARAM_STR); // **
          $update_stmt->bindValue(':idnota',       $batchDTO->getIdInvoice()   ?? null,    PDO::PARAM_INT); // **

          if ($update_stmt->execute()) {

            $text = "[ UPDATE ][ BATCH ] - [ Atualizando LOTE ID: {$batchDTO->getIdBatch()} ]".             // Salva topicos para log
            "[ ID nota-fiscal referente: {$old_id_invoice} > {$batchDTO->getIdInvoice()} ]";                // Concatenado.
            $log = write_log::write($text, "register");                                                     // Chamando função para registrar log

            return true;
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ BATCH / UPDATE ]"];                     // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        throw $error_pdo;                                                     // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ BATCH / UPDATE ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        throw $error_system;                                                  // Alerta controller de uma má execução com "1".
      }
    
    }



    /**
     * Function responsável por excluir um lote pelo ID.
     * 
     * @param int $id ID do lote a ser excluído
     * 
     * @return bool|array   - Boa ou má execução
     */
    public function delete(BatchDTO $batchDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Query para verificar se existe alguma tabela entrada relacionada ao lote indicado ($id_sent)
        $query = "SELECT idlote FROM entrada WHERE idlote = :idlote_fk";                                // Query para buscar ID do lote na entrada
        $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
        $stmt->bindParam(':idlote_fk',       $batchDTO->getIdBatch(),         PDO::PARAM_INT);          // Dando valor ao espaço declarado
        $stmt->execute();                                                                               // Executando query.


        // Verifica se não há registro de entrada no lote atual
        if ($stmt->rowCount() == 0) {

          // Query para efetuar deleção de lote
          $delete_query = "DELETE FROM lote WHERE idlote = :idlote";                                    // Query para deletar lote pelo ID indicado
          $delete_stmt  = $this->conn->prepare($delete_query);                                          // Preparando sintaxe
          $delete_stmt->bindParam(':id_sent',      $batchDTO->getIdBatch(),       PDO::PARAM_INT);      // Dando valor ao espaço declarado
          
          // Verificando se há uma boa execução
          if ($delete_stmt->execute()) {

            $text =["[ DELETE ][ BATCH ] - [ ID: {$batchDTO->getIdBatch()} ]"];                         // Salva topicos para log
            $log = write_log::write($text, 'register');                                                 // Chama função para escrever topicos
            return true;
          }

        } else {

          // Avisar que existe registros de entrada relacionado ao lote selecionado.
          return false;
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ BATCH / DELETE ]"];                     // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        throw $error_pdo;                                                     // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ BATCH / DELETE ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        throw $error_system;                                                  // Alerta controller de uma má execução com "1".
      }
    }



    /**
     * Function responsável em deletar dados de lote.
     * Além de criar, ele registra ações relacionada a ela.
     * 
     * @param BatchDTO      - classe que possui dados de lote
     * 
     * @return array        - Boa execução (array), má execução (false)
     */
    public function selectAll(): array {

      try {

        $query = "SELECT * FROM lote";
        $stmt  = $this->conn->prepare($query);
        
        
        if ($result = $stmt->execute()) {

          $batch_array = [];
          while ($result = $stmt->feth(PDO::FETCH_ASSOC)) {

            $batch = new BatchDTO($result['cod'], $result['data_criacao'], $result['idnota']);
            $batch_array[intval($result['idlote'])] = $batch;
          }
          return $batch_array;
        }

        //> Tratativa de erro relacionado ao Banco de Dados.
      } catch(PDOException $error_pdo) {
        
        $text = ["[ BD ][ BATCH / GET ALL ]"];                                // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Solicita função para escrever registro.
        throw $error_pdo;                                                     // Retorna ao controller de uma má execução com "1".
        
        //> Tratativa de erro relacionado ao Sistema.
      } catch(Exception $error_system) {
        
        $text = ["[ SYSTEN ]", "[ MODEL ] [ BATCH / GET ALL ]"];              // Salva topicos para log
        $log = write_log::write($text, 'error-system', $error_system);        // Solicita função para escrever registro.
        throw $error_system;                                                  // Retorna ao controller de uma má execução com "1".
      }
      
      // Return não está no lugar ideal por conta de possiveis erro.
    }



    /**
     * Function responsável por obter um lote por ID.
     * 
     * @param int $id ID do lote a ser buscado
     * 
     * @return BatchDTO|false Retorna o lote encontrado ou false se não encontrado
     */
    public function selectById(int $id): mixed {

      try {
        $query = "SELECT * FROM lote WHERE idlote = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
          if ($result) {

            return new BatchDTO($result['cod'], $result['data_criacao'], $result['idnota']);
          }
        }
        
        // Não foi encontrado um lote com o ID especificado
        return false;

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch(PDOException $error_pdo) {

        $text = ["[ BD ][ BATCH / GET BY ID ]"];                              // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Solicita função para escrever registro.
        throw $error_pdo;                                                     // Retorna ao controller array PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch(Exception $error_system) {

        $text = ["[ SYSTEN ]", "[ MODEL ] [ BATCH / GET BY ID ]"];            // Salva topicos para log
        $log = write_log::write($text, 'error-system', $error_system);        // Solicita função para escrever registro.
        throw $error_system;                                                  // Retorna ao controller array Exception.
      }

    }

  }

