<?php
  //======================================================================
  // MODEL - CATEGORIA
  //======================================================================
  namespace App\Model;              // Nomeclatura

  use PDO;                          // Usando classes internas do PHP por meio do Namespace
  use PDOException;                 // **
  use Exception;                    // **

  use App\Model\DTO\CategoryDTO;    // Usando classes próprio do sistema
  use Core\DataBase;                // **
  use Utils\write_log;              // **

  class ModelCategory {

    static  $update_class = false;
		private $conn;


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



    public function insert(CategoryDTO $categoryDTO): bool {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        $query = "SELECT nome FROM categoria WHERE nome = :nome";                             // Query para verificar nomes indenticos.
        $stmt = $this->conn->prepare($query);                                                 // Preparando sintaxe SQL
        $stmt->bindParam(':nome',     $categoryDTO->getName(),    PDO::PARAM_STR);            // Dando valor ao espaço declarado
        $stmt->execute();                                                                     // Executando sintaxe


        // Verifica se não há nenhum registro com o nome enviado.
        if ($stmt->rowCount() == 0) {
          
          $insert_query = "INSERT INTO categoria (nome) VALUES (:nome)";                      // Query para inserir uma nova categoria
          $insert_stmt  = $this->conn->prepare($insert_query);                                // Preparando sintaxe SQL
          $insert_stmt->bindParam(':nome',      $categoryDTO->getName(),     PDO::PARAM_STR); // Dando valor ao espaço declarado
          

          // Verifica se há um inserção bem-sucedida.
          if ($insert_stmt->execute()) {

            self::$update_class = false;                                                      // Avisando que a class não está atualizado
            $text = "[ INSERT ][ CATEGORY ] - [ Nome - {$categoryDTO->getName()} ]";          // Salva topicos para log
            $log = write_log::write($text, "register");                                       // Chamando função para escrever registro

          // Em caso de não haver uma boa execução da inserção
          }
          
        // Em caso de haver registro com o nome inserido.
        } else {
          $text = "[ FAILURE ] -> [ CATEGORY ][ INSERT ] - [ Nome já existente: '{$categoryDTO->getName()}' ]"; // Salva topicos para log
					$log = write_log::write($text, "register");                                                           // Chamando função para escrever registro
          // Sem return para o próprio Catch registrar o erro falta.
        }


      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ BD ] -> [ CATEGORY / INSERT ]"];                          // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return 1;                                                             // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ SYSTEN ] -> ","[ MODEL ]  [ CATEGORY / INSERT ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      }







    }

  }