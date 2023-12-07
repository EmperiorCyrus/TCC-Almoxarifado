<?php
  //======================================================================
  // MODEL - FORNECEDOR
  //======================================================================
  namespace App\Model;
  // require_once("../../core/database.php");

  use Core\DataBase;
  use PDO;
  
  class supplier {

    private $company;       // nome da empresa.
    private $email;         // E-mail da empresa.
    private $telephone;     // Telefone da empresa.


    /**
     * Function responsável por adicionar novo fornecedor ao BD.
     * Usando PDO para fazer as query e aumentando a proteção do BD,
     * Além de verificar a existência de dados repetidos.
     * 
     * @param string $get_name
     * @param string $get_email
     * @param string $get_telephone
     * 
     * @return void
     */
    public function insert($get_company, $get_email, $get_telephone) {

      $conn = database::connect();
      
      // Query para verificar se há igualdade de email.
      $query = "SELECT email FROM fornecedor WHERE email = :email"; // Montando query sql e reservando espaço email.
      $stmt = $conn->prepare($query);                               // Instância e prepara a declaração para execução.
      $stmt->bindParam(':email', $get_email, PDO::PARAM_STR);       // Dando valor ao espaço declarado
      $stmt->execute();                                             // Aceitando valor e executando.

      // Se houver resposta de igualdade, alertar.
      if ($stmt->rowCount() > 0) {
       
        /**
         * Exibir erro
         */
        
      // Se não houver resposta de igualdade, sistema processegue a execução.
      } else {

        $insert_query = "INSERT INTO empresa (empresa, email, telefone) VALUES (:empresa, :email, :telefone)";
        $insert_stmt = $conn->prepare($insert_query);          // Instância e prepara a declaração para a execução
        // Dando valores para os espaços declarados.
        $insert_stmt->bindParam(':name',      $get_company,   PDO::PARAM_STR);            // Preenchendo Empresa
        $insert_stmt->bindParam(':email',     $get_email,     PDO::PARAM_STR);          // Preenchendo E-mail
        $insert_stmt->bindParam(':telephone', $get_telephone, PDO::PARAM_STR);  // Preenchendo Telefone

        // Executando.
        if ($insert_stmt->execute()) {
          // Informar que foi cadastrado
        } else {
          // Informar erro ao cadastrar
        }

      }

    }


    /**
     * Function responsável por alterar a empresa (nome).
     * @param string $get_name_company.
     * 
     * @return void
     */
    public function alter_name_conpany($get_name, $get_email) {
      
      $conn = database::connect();

      $query = "UPDATE fornecedor SET nome = :nome WHERE email = :email";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':nome', $get_name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $get_email, PDO::PARAM_STR);

      // Verificar se a execução foi bem sucedida.
      if ($stmt->execute()) {
        // Informar que o nome foi alterado
      } else {
        // Informar que não foi alterado
      }
    }


    /**
     * Function responsável por alterar o email da empresa.
     * @param string
     * 
     * @return void
     */
    public function alter_email_conpany($get_email) {

    }

    /**
     * Function responsável por alterar o telefone da empresa.
     * @param string
     * 
     * @return void
     */
    public function alter_telephone_conpany($get_telephone) {

    }


    /**
     * Function responsável por enviar dados da empresa.
     * Ele enviará os nomes da empresa e modificará para JSON para ser montando um Select.
     * 
     * @return vector
     */
    public function send_json_name() {

    }



  }

?>