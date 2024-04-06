<?php
  //======================================================================
  // MODEL - PRODUTO
  //======================================================================
  namespace App\Model;

  use PDO;                              // Usando classes internas do PHP por meio do Namespace
  use PDOException;                     // **
  use Exception;                        // **

  use App\Model\DTO\ProductDTO;         // Usando classes próprio do sistema.
  use Core\DataBase;                    // **
  use Utils\write_log;                  // **


  /**
   * Class responsável pela manipulação geral do produto.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class ModelProduct {

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



    /** 
     * Function responsável por cadastrar um novo produto.
     * Ele altera, registra ações relacionada e retorna erros em exceções.
     * 
     * @param ProductDTO      - classe que possui dados de produto
     * 
     * @return bool|array     - Boa (true) |  má execução (Exceptions)
     */
    public function insert(ProductDTO $productDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        $query = "SELECT nome, marca FROM produto WHERE nome = :nome AND marca = :marca";               // Query para verificar a existencia de um produto indêntico
        $stmt = $this->conn->prepare($query);                                                                 // Preparando sintaxe SQL
        $stmt->bindParam(':nome',       $productDTO->getName(),       PDO::PARAM_STR);                  // Dando valor aos espaços resevados
        $stmt->bindParam(':marca',      $productDTO->getBrand(),      PDO::PARAM_STR);                  // **
        
        // Verificando se há execução bem-sucedida
        if ($stmt->execute()) {

          // Verifica se não há existencia de produto idêntico
          if ($stmt->rowCount() == 0) {
          
            $name        = $productDTO->getName();                            // Armazenando atributos em variaveis para evitar alerta de sistema
            $brand       = $productDTO->getBrand();                           // **
            $min         = $productDTO->getMin();                             // **
            $measurement = $productDTO->getMeasurement();                     // **
            $disposable  = $productDTO->getDisposable();                      // **
            $perishable  = $productDTO->getPerishable();                      // **
            $idcategory  = $productDTO->getCategory();                        // **
            $idsupplier  = $productDTO->getIdSupplier();                      // **
            $idstorage   = $productDTO->getIdStorage();                       // **

            // Montando query para inserir novo produto
            $insert_query = "INSERT INTO produto (nome, marca, minimo, medida_unidade, fornecedor,categoria, descartavel, perecivel, armazem) 
                            VALUES (:nome, :marca, :minimo, :medida_unidade, :fornecedor, :categoria, :descartavel, :perecivel, :validade, :armazem)";
            $insert_stmt = $this->conn->prepare($insert_query);                                               // Preparando sintaxe SQL
            $insert_stmt->bindParam(':nome',            $name,                    PDO::PARAM_STR);      // Dando valores aos espaços declarado
            $insert_stmt->bindParam(':marca',           $brand,                   PDO::PARAM_STR);      // **
            $insert_stmt->bindParam(':minimo',          $min,                     PDO::PARAM_INT);      // **
            $insert_stmt->bindParam(':medida_unidade',  $measurement,             PDO::PARAM_STR);      // **
            $insert_stmt->bindParam(':descartavel',     $disposable,              PDO::PARAM_STR);      // **
            $insert_stmt->bindParam(':perecivel',       $perishable,              PDO::PARAM_STR);      // **
            $insert_stmt->bindValue(':categoria',       $idcategory     ?? null,  PDO::PARAM_STR);      // **
            $insert_stmt->bindValue(':fornecedor',      $idsupplier     ?? null,  PDO::PARAM_INT);      // **
            $insert_stmt->bindValue(':armazem',         $idstorage      ?? null,  PDO::PARAM_INT);      // **

            
            // Verificando se há execução bem-sucedida
            if ($insert_stmt->execute()) {

              $text = "[ INSERT ][ PRODUCT ] - [ Nome: {$productDTO->getName()} & Marca: {$productDTO->getBrand} ]";  // Salva topicos para log
              $log = write_log::write($text, "register");                                                             // Chamando função para escrever registro
              return true;                                                                                            // Retorna true ao controller indicando sucesso.
            }
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ PRODUCT / INSERT ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return $error_pdo;                                                    // Retorna array ao controller com PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ PRODUCT / INSERT ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Retorna array ao controller com Exception.
      }
    }


    /**
     * Function responsável pela atualização do produto.
     * Ele atualiza, registra ações relacionada e retorna erros em exceções.
     * 
     * @param ProductDTO - classe que possui dados de produto
     * 
     * @return bool|array - Boa (true)| má execução (Exceptions)
     */
    public function update(ProductDTO $productDTO) {

      //> Analiza execuções dentro da função de possiveis erros e falha.
      try {

        $idproduct   = $productDTO->getIdProduct();                           // Armazenando atributos em variaveis para evitar alerta de sistema
        $name        = $productDTO->getName();                                // **
        $brand       = $productDTO->getBrand();                               // **
        $min         = $productDTO->getMin();                                 // **
        $measurement = $productDTO->getMeasurement();                         // **
        $perishable  = $productDTO->getPerishable();                          // **
        $disposable  = $productDTO->getDisposable();                          // **
        $idcategory  = $productDTO->getIdCategory();                          // **
        $idsupplier  = $productDTO->getIdSupplier();                          // **
        $idstorage   = $productDTO->getIdStorage();                           // **
      

        // Query para atualizar dados do produto, sendo possivel atualizar qualquer atributo.
        $update_query = "UPDATE produto SET nome = :nome, marca = :marca, pericivel = :pericivel, descartavel = :descartavel,
        idcategoria = :idcategoria, idfornecedor = :idfornecedor, idarmazem = :idarmazem WHERE idproduto = :idproduto";
        $stmt_query = $this->conn->prepare($update_query);                                              // Preparando sintaxe SQL
        $stmt_query->bindParam(':idproduto',      $idproduct,                 PDO::PARAM_INT);          // Dando valores ao espaços declarados
        $stmt_query->bindValue(':name',           $name         ?? null,      PDO::PARAM_STR);          // **
        $stmt_query->bindValue(':marca',          $brand        ?? null,      PDO::PARAM_STR);          // **
        $stmt_query->bindValue(':pericivel',      $perishable   ?? null,      PDO::PARAM_STR);          // **
        $stmt_query->bindValue(':descartavel',    $disposable   ?? null,      PDO::PARAM_STR);          // **
        $stmt_query->bindValue(':idcategoria',    $idcategory   ?? null,      PDO::PARAM_INT);          // **
        $stmt_query->bindValue(':idfornecedor',   $idsupplier   ?? null,      PDO::PARAM_INT);          // **
        $stmt_query->bindValue(':idarmazem',      $idstorage    ?? null,      PDO::PARAM_INT);          // **
        
        // verifica se há execução bem-sucedida
        if ($stmt_query->execute()) {

          $text = "[ UPDATE ][ PRODUCT ] - [ Produto ID: {$productDTO->getIdProduct()} ]";              // Salva topicos para log
          $log = write_log::write($text, "register");                                                   // Chamando função para escrever registro
          return true;                                                                                  // Retorna true ao controller indicando sucesso.
        } 


      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ PRODUCT / UPDATE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return $error_pdo;                                                    // Retorna array ao controller com PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ PRODUCT / UPDATE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Retorna array ao controller com Exception.
      }
    }


    public function delete(ProductDTO $productDTO) {

      try {

        $query = "SELECT idproduto FROM";









        //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ PRODUCT / DELETE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);              // Chamando função para escrever erro do BD no log
        return $error_pdo;                                                    // Retorna array ao controller com PDOException.

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_system) {

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ PRODUCT / DELETE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_system);        // Chamando função para escrever erro de sistema no log
        return $error_system;                                                 // Retorna array ao controller com Exception.
      }

    }


    
    /**
     * Function responsavel em recarregar todos os dados do produto.
     * Recarregar, refazer comando SQL para adquirir dados atualizados sobre produto,
     * Além de encapsular todos os dados adiquiridos para uso futuros por outras functions.
     * 
     * @return array
     */
    private function reload_all_product() {

      $conn = database::connect();                                  // Conexão com o Banco de Dados.
      
      $query = "SELECT * FROM produto";                             // Montando Query SQL
      $stmt  = $conn->prepare($query);                              // Preparando 

      $produtos = [];                                               // Array de produtos para melhor organização das chaves e valores #

      // Executando e encapsulando se houver uma execução.
      if ($stmt->execute()) {                                       

        
        // $count_row = 0;                                           // Contador de linhas
        // Separando resultador por categoria
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {                                 
          
          $produto = [                                               // Criando um produto inteiro para o array total de produtos #
            "id"             => $row['id_produto'],                  // Encapsulando resultado por sua categoria
            "name"           => $row['nome'],                        // **
            "brand"          => $row['marca'],                       // **
            "supplier"       => $row['idfornecedor'],                // **
            "category"       => $row['idcategoria'],                 // **
            "disposable"     => $row['descartavel'],                 // **
            "perishable"     => $row['perecivel'],                   // **
            "validity"       => $row['validade'],                    // **
            "storage"        => $row['idarmazem'],                   // **
            "creation_date"  => $row['data_criacao'],                // **
          ];

          $produtos[] = $produto;                                    // Adicionando novo produto no array de produtos #
          // $count_row++;                                           // Adição de linhas
        }

      // Caso não houver uma execução bem-sucedida.
      } else {

        // Exibir erro de falha de execução
      }

      return $produtos;
    }



    /**
     * Função responsavel por retornar todos os valores.
     * Com um auxílio de outra função para obter novamente os dados do BD
     * e atualizar o encapsulamento,
     * Ele armazena os valores em uma array.
     * 
     * @return array    $all_info
     */
    public function get_all_info_product() {

      // Chama função para atualizar o encapsulamento com o BD
      // $this->reload_all_product();                            
      
      // Armazena os produtos para depois enviar para o front #
      $all_info = $this->reload_all_product();

      // Retornando array
      return $all_info;
    }








    /**
     * Function responsavel por obter apenas os nomes do produto.
     * Possuindo funcionalidade dupla, a function é capaz de obter todos os nomes do produto,
     * Como também, obter um único nome correspondente ao parametro para uma pesquisa objetiva.
     * $get_name se for nulo, sempre irá fazer uma requisição de array caso haja mais de um valor;
     * $get_name haver dados, sempre irá fazer uma requisição do nome especifico. 
     * 
     * @param string        $get_name   - Não obrigatório
     * 
     * @return string|array $result
     */
    public function get_name_product($get_name = null) {

      $conn = database::connect();                                  // Conexão com o Banco de Dados.
      
      
      $reload_query = true;                                         // Variavel controlador.
      if (!empty($this->name)) {                                    // Se houver dados na variavel $nome [...]

        if (is_array($this->name)  && !$get_name)        $reload_query = false;  // Se name for array e parametro nulo*
        if (is_string($this->name) && !empty($get_name)) $reload_query = false;  // Se name for string e parametro possuir valor*

        if (!$reload_query) {
          return $this->name; // Retorna objeto invés de continuar com o query.
        }
      }


      // Recarrega a query caso necessario.
      if ($reload_query) {
        $query = "SELECT nome FROM produto";                        // Montando Query para puxar nome dos produtos

        if (isset($get_name))                                       // Verificando se a variavel do parametro possui valor. 
          $query .= " WHERE nome = '$get_name'";                    // Montando uma excessão para a query.
        
        $stmt  = $conn->prepare($query);                            // Preparando a Query
        $stmt->execute();                                           // Executando
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);                // Montando array contendo o resultado

        $this->name = $result;                                      // Armazenando resultado para o objeto.


        return $result;
      }




    }



  }




  //$produto = new product();
  //$produto->get_all_info_product();