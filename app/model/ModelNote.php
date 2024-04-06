<?php
  //======================================================================
  // MODEL - NOTA
  //======================================================================
  namespace App\Model;

  use App\Model\DTO\NoteDTO;
  use Core\DataBase;
  use PDO;

  use PDOException;
  use Exception;
  use Utils\write_log;

  /**
   * Class responsável pela manipulação geral de todo o nota.
   * Usando sintaxe SQL com o método PDO nas funções de manipulações.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class ModelNote {

    private $conn;                         // Conexão com o BD



    /**
     * Construtor responsável em instanciar a conexão com o BD.
     * Armazenando numa propriedade para futuras reutilização.
     * TODO: Corrigir possíveis bugs (copiado de batch para nota)
     */
    public function __construct() {
      $this->conn = Database::connect();                  // Instancia e guarda Conexão
      if ($this->conn instanceof PDOException) {          // Verifica se houver erro
        throw new PDOException($this->conn);              // Retorna erro da conexão
      } 
    }



    /**
     * Function responsável em criar um novo nota.
     * Além de criar, ele registra ações relacionada a ela.
     * TODO: Corrigir possíveis bugs (copiado de batch para nota)
     * @param NoteDTO      - classe que possui dados de nota
     * 
     * @return bool|array   - Boa ou má execução
     */
    public function insert(NoteDTO $noteDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Query para verificar a existencia da NOTA referente.
        $query = "SELECT idnota FROM nota WHERE idnota = :idnota";                               // Query para identificar ID correspondente na tabela nota.
        $stmt = $this->conn->prepare($query);                                                       // Preparando sintaxe SQL.
        $stmt->bindParam(':idnota',      $noteDTO->getIdInvoice(),     PDO::PARAM_INT);         // Dando valor ao espaço declarado.

        // Verificando se a execução foi bem-sucedida.
        if ($stmt->execute()) { 

          // Verificando se a resposta da query é apenas 1.
          if ($stmt->rowCount() == 1) {

            $insert_query = "INSERT INTO nota (idnota) VALUE (:idnota, :cod)";                       // Query para inserir um novo nota com o ID da nota-fiscal.
            $insert_stmt  = $this->conn->prepare($insert_query);                                    // Preparando sintaxe.
            $insert_stmt->bindParam(':idnota',      $noteDTO->getIdInvoice(),     PDO::PARAM_INT); // Dando valor ao espaço declarado.
            $insert_stmt->bindParam(':cod',         $noteDTO->getCod(),           PDO::PARAM_INT); // **
            
            // Verifica se há uma boa execução
            if ($insert_stmt->execute()) {

              $text = "[ CREATE ][ NOTE ] - [ Nota da Nota-Fiscal ID: {$noteDTO->getIdInvoice()} ]";   // Salva topico para log,
              $log = write_log::write($text, "register");                                                // Chama função para registrar tópico.
            }
          }
        }


      //> Tratativa de erro relacionado ao Banco de Dados.
      
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ NOTE / CREATE ]"];                     // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return $error_pdo;                                                    // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ NOTE / CREATE ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Alerta controller de uma má execução com "1".
      }

      return 0;
    }
  


    /**
     * Function responsável em atualizar dados de nota.
     * Além de criar, ele registra ações relacionada a ela.
     * TODO: Corrigir possíveis bugs (copiado de batch para nota)
     * @param NoteDTO      - classe que possui dados de nota
     * 
     * @return bool|array   - Boa ou má execução
     */
    public function update(NoteDTO $noteDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Querys para obter ID da nota antes de ser atualizado
        $query = "SELECT idnota FROM nota WHERE idnota = :idnota";                                          // Query para buscar ID da nota relacionada
        $stmt  = $this->conn->prepare($query);                                                              // Preparando sintaxe SQL
        $stmt->bindParam('idnota',       $noteDTO->getIdNote(),       PDO::PARAM_INT);                    // Dando valor ao espaço declarado

        // Verificando se há uma boa execução.
        if ($stmt->execute()) {

          $result = $stmt->fetch(PDO::FETCH_ASSOC);                                                         // Obtendo resultado
          $old_id_invoice = $result['idnota'];                                                              // Salvando ID da nota no resultado

          // Query para atualizar o ID da nota relacionada.
          $update_query = "UPDATE nota SET cod = :cod, id_nota = :id_nota WHERE id = :id_sent";             // Query para a atualização de nota e código.

          $update_stmt  = $this->conn->prepare($update_query);                                              // Preparando sintaxe
          $update_stmt->bindParam(':idnota',       $noteDTO->getIdNote(),                PDO::PARAM_INT); // Dando valores aos espaços declarados
          $update_stmt->bindValue(':cod',          $noteDTO->getCod()         ?? null,    PDO::PARAM_STR); // **
          $update_stmt->bindValue(':idnota',       $noteDTO->getIdInvoice()   ?? null,    PDO::PARAM_INT); // **

          if ($update_stmt->execute()) {

            $text = "[ UPDATE ][ NOTE ] - [ Atualizando NOTA ID: {$noteDTO->getIdNote()} ]".             // Salva topicos para log
            "[ ID nota-fiscal referente: {$old_id_invoice} > {$noteDTO->getIdInvoice()} ]";                // Concatenado.
            $log = write_log::write($text, "register");                                                     // Chamando função para registrar log

            return true;
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ NOTE / UPDATE ]"];                     // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        throw $error_pdo;                                                     // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ NOTE / UPDATE ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        throw $error_system;                                                  // Alerta controller de uma má execução com "1".
      }
    
    }



    /**
     * Function responsável por excluir um nota pelo ID.
     * TODO: Corrigir possíveis bugs (copiado de batch para nota)
     * @param int $id ID do nota a ser excluído
     * 
     * @return bool|array   - Boa ou má execução
     */
    public function delete(NoteDTO $noteDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Query para verificar se existe alguma tabela entrada relacionada ao nota indicado ($id_sent)
        $query = "SELECT idnota FROM entrada WHERE idnota = :idnota_fk";                                // Query para buscar ID do nota na entrada
        $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
        $stmt->bindParam(':idnota_fk',       $noteDTO->getIdNote(),         PDO::PARAM_INT);          // Dando valor ao espaço declarado
        $stmt->execute();                                                                               // Executando query.


        // Verifica se não há registro de entrada no nota atual
        if ($stmt->rowCount() == 0) {

          // Query para efetuar deleção de nota
          $delete_query = "DELETE FROM nota WHERE idnota = :idnota";                                    // Query para deletar nota pelo ID indicado
          $delete_stmt  = $this->conn->prepare($delete_query);                                          // Preparando sintaxe
          $delete_stmt->bindParam(':id_sent',      $noteDTO->getIdNote(),       PDO::PARAM_INT);      // Dando valor ao espaço declarado
          
          // Verificando se há uma boa execução
          if ($delete_stmt->execute()) {

            $text =["[ DELETE ][ NOTE ] - [ ID: {$noteDTO->getIdNote()} ]"];                         // Salva topicos para log
            $log = write_log::write($text, 'register');                                                 // Chama função para escrever topicos
            return true;
          }

        } else {

          // Avisar que existe registros de entrada relacionado ao nota selecionado.
          return false;
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ NOTE / DELETE ]"];                     // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        throw $error_pdo;                                                     // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ NOTE / DELETE ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        throw $error_system;                                                  // Alerta controller de uma má execução com "1".
      }
    }



    /**
     * Function responsável em deletar dados de nota.
     * Além de criar, ele registra ações relacionada a ela.
     * 
     * @param NoteDTO      - classe que possui dados de nota
     * 
     * @return array        - Boa execução (array), má execução (false)
     */
    public function selectAll(): array {

      try {
        $conn = database::connect();                               // Conexão com o Banco de Dados.
      
        $query = "SELECT * FROM nota";                             // Montando Query SQL
        $stmt  = $conn->prepare($query);                           // Preparando 
  
        $notas = [];                                               // Array de notas para melhor organização das chaves e valores #
  
        // Executando e encapsulando se houver uma execução.
        if ($stmt->execute()) {                                       
  
          // Separando resultador por categoria
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {                                 
            
            $nota = [                                             // Criando um nota inteiro para o array total de notas #
              "id"             => $row['idnota'],                 // Encapsulando resultado por sua categoria
              "path"           => $row['path'],                   // **
              "description"    => $row['descricao'],              // **
              "name"           => $row['nome'],                   // **
              "created_at"     => $row['data_criacao'],           // **
            ];
  
            $notas[] = $nota;                                     // Adicionando novo nota no array de notas #
          }

          return $notas;
        }

        //> Tratativa de erro relacionado ao Banco de Dados.
      } catch(PDOException $error_pdo) {
        
        $text = ["[ BD ][ NOTE / GET ALL ]"];                                // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Solicita função para escrever registro.
        throw $error_pdo;                                                     // Retorna ao controller de uma má execução com "1".
        
        //> Tratativa de erro relacionado ao Sistema.
      } catch(Exception $error_system) {
        
        $text = ["[ SYSTEN ]", "[ MODEL ] [ NOTE / GET ALL ]"];              // Salva topicos para log
        $log = write_log::write($text, 'error-system', $error_system);        // Solicita função para escrever registro.
        throw $error_system;                                                  // Retorna ao controller de uma má execução com "1".
      }
      
      // Return não está no lugar ideal por conta de possiveis erro.
    }



    /**
     * Function responsável por obter um nota por ID.
     * TODO: Corrigir possíveis bugs (copiado de batch para nota)
     * @param int $id ID do nota a ser buscado
     * 
     * @return NoteDTO|false Retorna o nota encontrado ou false se não encontrado
     */
    public function selectById(int $id): mixed {

      try {
        $query = "SELECT * FROM nota WHERE idnota = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
          if ($result) {

            return new NoteDTO($result['cod'], $result['data_criacao'], $result['idnota']);
          }
        }
        
        // Não foi encontrado um nota com o ID especificado
        return false;

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch(PDOException $error_pdo) {

        $text = ["[ BD ][ NOTE / GET BY ID ]"];                              // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Solicita função para escrever registro.
        throw $error_pdo;                                                     // Retorna ao controller array PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch(Exception $error_system) {

        $text = ["[ SYSTEN ]", "[ MODEL ] [ NOTE / GET BY ID ]"];            // Salva topicos para log
        $log = write_log::write($text, 'error-system', $error_system);        // Solicita função para escrever registro.
        throw $error_system;                                                  // Retorna ao controller array Exception.
      }

    }

  }

