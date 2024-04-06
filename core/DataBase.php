<?php
  namespace Core;

  use PDO;
  use PDOException;
  
  class DataBase {

    private static $conn; // Conexão

    private $host = "localhost";
    private $name = "sga";
    private $user = "root";
    private $key  = "password";


    /**
     * Function statica responsável pela conexão ao BD.
     * Usando PDO, ela montará o DSN com alguns tratativos.
     * 
     * @return $conn / conexão do BD.
     */
    public static function connect() {
      // Criando estância da própria class.
      $DB = new self();

      // Caso não haja conexão criada previamente. Se sim, é negada a execução.
      if (!self::$conn) {
        // Informando localização do BD para o DNS.
        $dsn = "mysql:host=". $DB->host. ";dbname=". $DB->name;
        
        // Try Catch para configuração de PDO para autenticação do BD
        try {
          self::$conn = new PDO($dsn, $DB->user, $DB->key);                     // Autenticação.
          self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configurando o ATTR_ERRMODE.
          
        // Encerra o sistema e e exibe o erro.
        } catch (PDOException $e) {
          die ("Erro na conexão com o banco de dados: ". $e->getMessage());
        }

      }
      return self::$conn;
    }

  }

  // var_dump(database::connect());

?>