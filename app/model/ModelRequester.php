<?php
  //======================================================================
  // MODEL - SOLICITANTE
  //======================================================================

  namespace App\Model;  // Nomeclatura

  use PDO;              // Users de bibliotecas
  use PDOException;     // **
  use Exception;        // **

  use Core\DataBase;    // Users de arquivos
  use Utils\write_log;  // **
  
  
  /**
   * Wesley lindo
   * Luis Concorda
   */
	class ModelRequester {

		static $att_class_requester = false;
		private $conn;



		// Construct para instanciar a conexão
		public function __construct() {
			$this->conn = DataBase::connect();
		}



    /**     
     * Function responsável por criar um novo solicitante
     * Além de criar, ele registra ações relacionada a ela.
     * 
     * @param string    $name_sent
     * @param string    $email_sent
     * 
     * @return int      0|1 - Boa ou má execução
     */
    public function new_requester($name_sent, $email_sent) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

			$query = "SELECT email FROM solicitante WHERE email = :email";                                    // Query para verificar email
			$stmt = $this->conn->prepare($query);                                                             // Preparando sintaxe SQL
			$stmt->bindParam(':email',							$email_sent, 			PDO::PARAM_STR);                        // Dando valores aos espaços declarados


      // Verifica se há uma execução bem-sucedida.
			if ($stmt->execute()) {

        // Verifica se não há nenhum resultado com o email inserido
				if ($stmt->rowCount() == 0) {

					// Montando Query para criar uma nova nota fiscal.
					$insert_query = "INSERT INTO solicitante (nome, email) VALUES (:nome, :email)"; 							// Query para inserir dados         
					$insert_stmt = $this->conn->prepare($insert_query);                                           // Preparando sintaxe SQL
					$insert_stmt->bindParam(':nome',         $name_sent,                   PDO::PARAM_STR);       // Dando valores aos espaços declarado
					$insert_stmt->bindParam(':email',        $email_sent,                  PDO::PARAM_STR);       // **
				

          // Verifica se uma execução bem-sucedida.
					if ($insert_stmt->execute()) {

						self::$att_class_requester = false;                               // Avisando que a class não está atualizado

            // Registro para criação de dados
						$text = "[ CREATE ] --> [ REQUESTER ] -> [ Nome: '{$name_sent}' & E-mail: '{$email_sent}' ]";   // Salva topicos para log
						$log = write_log::write($text, "register");                                                                   // Chamando função para escrever registro

          // Em caso de uma má execução da inserção de dados. ok
					} else {

            $text = "[ FAILURE ] -> [ REQUESTER ][ CREATE ] - [ Falha ao executar novo solicitante ][ Nome: '{$name_sent}' ][ E-mail: '{$email_sent}' ]";                      // Salva topicos para log
						$log = write_log::write($text, "register");                                                               // Chamando função para escrever registro
            // Sem return para o próprio Catch registrar o erro falta.
          }

        // Em caso de já houver o email registrado.
				} else {

            // Registro para elerta de Email em uso
            $text = "[ ALERT ] ---> [ REQUESTER ][ CREATE ] - [ O email: '{$email_sent}', já está em uso no Banco de Dados ]";           // Salva topicos para log
						$log = write_log::write($text, "register");                                     // Chamando função para escrever registro
            return 1;                                                         // Alerta controller de uma má execução com "1".
				}

      // Em caso de uma má execução da verificação de email
			} else {

        // Registro para exibir falha ao verificar Email.
        $text = "[ FAILURE ] -> [ REQUESTER ][ CREATE ] - [ Falha ao verificar email: '{$email_sent}' ]";                             // Salva topicos para log
        $log = write_log::write($text, "register");                                         // Chamando função para escrever registro	
        // Não há return, o próprio Try/Catch irá registrar o erro fatal.
			}

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ BD ] -> [ REQUESTER / CREATE ]"];                         // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);                            // Chamando função para escrever erro do BD no log
        return 1;                                                             // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ SYSTEN ] -> ","[ MODEL ]  [ REQUESTER / CREATE ]"];       // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);                      // Chamando função para escrever erro de sistema no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      }

      // Alerta controller de uma boa execução com "0".
      return 0;
    }




    /**
     * Function responsável em atualizar solicitante.
     * As querys SQL foram feita para o próprio solitante se atualizar
     * por meio do próprio E-mail.
     * 
     */
		public function update_requester($email_sent, $new_email = null, $new_name = null) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Querys para obter dados do solicitante antes de ser atualizado
        $query = "SELECT id, nome, email FROM solicitante WHERE email = :email";                        // Query para buscar dados do solicitante relacionado
        $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
        $stmt->bindParam(':email',       $email_sent,       PDO::PARAM_INT);                            // Dando valor ao espaço declarado


        // Verificando se há uma boa execução.
        if ($stmt->execute()) {

          // Precavendo bug ou erro ao verificar email a ser atualizado
          if ($stmt->rowCount() == 1) {

            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);                         // Salvando resultado da Query SQL.
            $id     = $result['id'];                                          // Separando resultado por titulo.
            $name   = $result['nome'];                                        // **
            $email  = $result['email'];                                       // **


            // variaveis reescritas $query & $stmt
            // Query oara verificar igualdade do novo e-mail no banco.
            $query = "SELECT email FROM solicitante WHERE email = :email";    // Query para verificar se o novo email já existe no BD.
            $stmt  = $this->conn->prepare($query);                            // Preparando sintaxe SQL
            $stmt->bindParam(':email',    $new_email,       PDO::PARAM_STR);  // Dando valor ao espaço declarado

            // Verifica se há uma boa execução.
            if ($stmt->execute()) {

              if ($stmt->rowCount() == 0) {

                // Query para atualizar o email ou o nome do solicitante
                $update_query = "UPDATE solicitante SET nome = :new_name, email = :new_email WHERE email = :email";               // Query para a atualização de nota e código.
                $update_stmt  = $this->conn->prepare($update_query);                                                              // Preparando sintaxe SQL
                $update_stmt->bindValue(':email',        	    $email_sent   	?? null,    PDO::PARAM_STR);      	                // Dando valor ao espaço declarado
                $update_stmt->bindValue(':new_name',          $new_name     	?? null,    PDO::PARAM_STR);     		                // **
                $update_stmt->bindValue(':new_email',         $new_email    	?? null,    PDO::PARAM_STR);     		                // **


                // Verifica se a execuçao é bem-sucedida.
                if (!$update_stmt->execute()) {
                  
                  self::$att_class_requester = false;                         // Avisando que a class não está atualizado
                  
                  $text = "[ UPDATE ][ REQUESTER ] - [ Atualizando ID: {$id} ][ E-mail: '{$email}' >> '{$new_email}' ]".          // Tópico: Solicitante atualizado
                                                    "[ Nome: '{$name}' >> '{$new_name}']";                                        // Concatenação
                  $log = write_log::write($text, "register");                                                                     // Chamando função para registrar tópico

                // Em caso de uma má execução da atualização de dados.
                } else {

                  $text = "[ FAILURE ][ REQUESTER ][ UPDATE ] - [ ID: {$id} ][ E-mail: '{$new_email}' ][ Nome: '{$new_name}' ]";  // Topico: Falha ao atualizar solicitante
                  $log = write_log::write($text, "register");                                                                     // Chamando função para registrar tópico
                  // Não há return, o próprio Try/Catch irá registrar o erro fatal.
                }

              // Em caso de houver igualdade com o novo email solicitado no BD.
              } else {

                // Registro para elerta de Email em uso
                $text = "[ ALERT ][ REQUESTER ][ UPDATE ] - [ O email: '{$new_email}', já está em uso no Banco de Dados ]";       // Salva topicos para log
						    $log = write_log::write($text, "register");                                                                       // Chamando função para escrever registro
                return 1;                                                                                                         // Alerta controller de uma má execução com "1". 
              }

            } else {

            }
          
          } else {


          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {

        $text = ["[ ERROR ][ BD ] - [ REQUESTER / UPDATE ]"];                 // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return 1;                                                             // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ REQUESTER / UPDATE ]"];    // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      }    

			return 0;
    }



		public function delete_requester($id_sent) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        // Query para verificar se existe alguma tabela entrada relacionada ao lote indicado ($id_sent)
        $query = "SELECT id FROM solicitante WHERE id = :id_solicitante";                               // Query para buscar ID do lote na entrada
        $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
        $stmt->bindParam(':id_solicitante',       $id_sent,         PDO::PARAM_INT);                    // Dando valor ao espaço declarado
        $stmt->execute();                                                                               // Executando query.

				
				// Verifica se não há resultado da query.
        if ($stmt->rowCount() == 0) {

          // Query para efetuar deleção de lote
          $delete_query = "DELETE FROM lote WHERE id = :id_sent";                                       // Query para deletar lote pelo ID indicado
          $delete_stmt  = $this->conn->prepare($delete_query);                                          // Preparando sintaxe
          $delete_stmt->bindParam(':id_sent',      $id_sent,       PDO::PARAM_INT);                     // Dando valor ao espaço declarado
          
          // Verificando se há uma boa execução
          if ($delete_stmt->execute()) {

            self::$att_class_requester = false;                                 // Avisando que a class não está atualizado

            $text =["[ DELETE ][ BATCH ] - [ ID: {$id_sent} ]"];              // Salva topicos para log
            $log = write_log::write($text, 'register');                                     // Chama função para escrever topicos

          }

        } else {

          // Avisar que existe registros de entrada relacionado ao lote selecionado.
          return 1;
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo) {

        $text = ["[ BD ] - [ BATCH / DELETE ]"];                     // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);                            // Chamando função para escrever erro do BD no log
        return 1;                                                             // Alerta controller de uma má execução com "1".

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ SYSTEN ]","[ MODEL ][ BATCH / DELETE ]"];        // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);                      // Chamando função para escrever erro de sistema no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      }
    }



    public function get_requester_for_id($id_sent) {

    }

    public function get_all_requester() {
      
    }


	}
