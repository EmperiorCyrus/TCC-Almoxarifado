<?php
  //======================================================================
  // MODEL - USUÁRIO
  //======================================================================
  namespace App\Model;

  use PDO;
  use PDOException;
  use Exception;

  use App\Model\DTO\UserDTO;
  use Core\DataBase;
  use Utils\write_log;

  /**
   *
   * TODO: Checkout
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0 
   */
  class ModelUser {

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
     * 
     */
    public function insert(UserDTO $userDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Obtendo valores antecipados para evitar conflitos com versões do PHP.
        $email = $userDTO->getEmail();
        $name = $userDTO->getName();
        $password = $userDTO->getPassword();
        
        // Query para verificar existencia de e-mails identicos
        $select_query = "SELECT email FROM usuario WHERE email = :email";                       // Query para buscar dados.
        $select_stmt  = $this->conn->prepare($select_query);                                    // Preparando sintaxe SQL.
        $select_stmt->bindValue(':email',       $email,         PDO::PARAM_STR);                // Dando valor ao espaço reservado.
        $select_stmt->execute();                                                                // Executando Query.

        // Executa caso não haja o email identico no BD.
        if($select_stmt->rowCount() == 0) {

          $query = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";   // Query para inserir um novo usuario.
          $stmt = $this->conn->prepare($query);                                                 // Preparando sintaxe SQL.
          $stmt->bindParam(':nome',       $name,        PDO::PARAM_STR);                        // Dando valores ao espaços declarados.
          $stmt->bindParam(':email',      $email,       PDO::PARAM_STR);                        // **
          $stmt->bindParam(':senha',      $password,    PDO::PARAM_STR);                        // **


          // Verifica se há execução bem-sucedida
          if ($stmt->execute()) {

            #Log
          

          } else {

            #Log
            #Retornar aviso de email existente
          }
        }


      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error){

        # Retorno para log

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        # Retorno para log
      }
    }



    public function update(UserDTO $userDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

      // Obtendo valores antecipados para evitar conflitos com versões do PHP.
      $name     = $userDTO->getName();
      $email    = $userDTO->getEmail();
      $password = $userDTO->getPassword();
      $type     = $userDTO->getIdusertype();

      // Query para atualizar dados de usuario
      $uptade_query = "UPDATE user SET nome = :nome, email = :email,  senha = :senha, tipo = :tipo WHERE idusuario = :id";
      $updade_stmt  = $this->conn->prepare($uptade_query);                                      // Preparando sintaxe SQL.
      $updade_stmt->bindValue(':nome',          $name       ?? null,          PDO::PARAM_STR);  // Dando valores ao espaços declarados
      $updade_stmt->bindValue(':email',         $email      ?? null,          PDO::PARAM_STR);  // **
      $updade_stmt->bindValue(':senha',         $password   ?? null,          PDO::PARAM_STR);  // **
      $updade_stmt->bindValue(':tipo',          $type       ?? null,          PDO::PARAM_INT);  // **

      // Verificando se há uma boa execução ao atualizar usuario
      if ($updade_stmt->execute()) {

        #LOG

      } else {

        #LOG
        #Retorno para uma má atualização
      }


        //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error){

        # Retorno para log

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        # Retorno para log
      }

    }




    /**
     * 
     * 
     */
    public function delete($userID) {

      try {
        
        $query = "SELECT nome, email FROM user WHERE iduser = :iduser";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':iduser',        $userID,      PDO::PARAM_INT);

        if ($stmt->execute()) {

          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          $delete_query = "DELETE from user WHERE iduser = :iduser";
          $delete_stmt  = $this->conn->prepare($delete_query);
          $delete_stmt->bindParam(':iduser',      $userID,      PDO::PARAM_INT);
          
          // Verificando se houve uma boa execução deleção de usuario
          if ($delete_stmt->execute()) {
            #LOG
            #Usar $result no log.

          } else {

            #LOG
            #Retorno de erro
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error){

        # Retorno para log

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        # Retorno para log
      }
    }


    /**
     * 
     */
    public function selectByID($userID) {
      
      try {

        $query = "SELECT u.idtipo_usuario, u.nome, u.senha, u.email, t.nome AS tipo FROM usuario u
                  INNER JOIN tipo_usuario t ON u.idtipo_usuario = t.id WHERE u.id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',   $userID,   PDO::PARAM_INT);
      
        
        var_dump($userID);
        echo ("antes de executar");
        if($stmt->execute()) {
          echo ("depois de executar");

          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          var_dump($result);
          $user = new UserDTO($result['nome'], $result['email'], $result['senha'], $result['tipo']);
          
          return $user;
          #LOG
        } else {
          #LOG
          #Retorno para uma má seleção
        }

      //> Tratativa de erro relacionado ao Banco de dados.
      } catch (PDOException $error) {
        # Retorno para o log
        return "erroPDO";
      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $errorSystem) {

        return "errorSystem";
        # Retorno para o log
      }
    }



    public function selectAll() {

      try {
    
        $selectQuery = "SELECT * FROM user;";
        $selectStmt = $this->conn->prepare($selectQuery);
    
        if ($selectStmt->execute()) {
          # Log
        } else {
          # Log
          # Retorno para uma má seleção
        }
    
      } catch (PDOException $error) {
        # Retorno para o log
      } catch (Exception $errorSystem) {
        # Retorno para o log
      }
    }


  }



