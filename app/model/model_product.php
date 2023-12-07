<?php
  //======================================================================
  // MODEL - PRODUTO
  //======================================================================
  namespace App\Model;
  session_start();

  use Core\DataBase;
  use PDO;
  //require_once('../../core/database.php');
  // require_once('../core/database.php');


  /**
   * Class responsável pela manipulação geral do produto.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class product {

    private $id;            // ID
    private $name;          // Nome 
    private $brand;         // Marca
    private $supplier;      // Fornecedor
    private $category;      // Categoria
    private $disposable;    // Descartavel
    private $perishable;    // Perecivel
    private $validity;      // Validade
    private $storage;       // Armazem
    private $creation_date; // Data de criação


    /**
     * Function responsável por adicionar um novo produto para o BD.
     * Usando PDO para fazer as query e aumentando a proteção do BD.
     * Podendo receber parte dos dados até todos dados para a criação do produto.
     * 
     * @param string    $get_name
     * @param string    $get_brand
     * @param int       $get_supplier     - Não é obrigatório
     * @param string    $get_category
     * @param bool      $get_disposable   - Não é obrigatório
     * @param bool      $get_perishable   - Não é obrigatório
     * @param           $get_validity     - Não é obrigatório
     * @param int       $get_armazem      - Não é obrigatório
     * 
     * @return void
     */
    public function new_product($get_name, $get_brand, $get_disposable = null, $get_perishable = null, $get_validity = null, $get_supplier = null, $get_category = null, $get_storage = null) {
      
      $conn = database::connect();                                                      // Conexão com o Banco de Dados.

      // Query para verificar igualdade de produto já existente por meio do nome e marca.
      $query = "SELECT nome, marca FROM produto WHERE nome = :nome AND marca = :marca"; // Monatando Query SQL e resevando espaços para atributos.
      $stmt = $conn->prepare($query);                                                   // Instância
      $stmt->bindParam(':nome',  $get_name,  PDO::PARAM_STR);                           // Dando valor aos espaços resevados
      $stmt->bindParam(':marca', $get_brand, PDO::PARAM_STR);                           // ***
      $stmt->execute();                                                                 // Aplicando e executando query.


      // Se houver resposta de igualdade
      if ($stmt->rowCount() > 0) {
        echo '<script>alert("Já existe esse produto no estoque.");</script>';           // Alerta de existencia
        echo '<script>window.location.href = "../../pages/cadastros.php";</script>';    // Hearder forçado.

      // Se não houver, sistema prossegue.
      } else {
        
        $_SESSION['erro'] = "Descartavel: {$get_disposable} <br> Perecivel: {$get_perishable}";
        // Montando query para inserir novo produto
        $insert_query = "INSERT INTO produto (nome, marca, fornecedor,categoria, descartavel, perecivel, validade, armazem) 
                         VALUES (:nome, :marca, :fornecedor, :categoria, :descartavel, :perecivel, :validade, :armazem)";
        $insert_stmt = $conn->prepare($insert_query);                                           // Isntância
        $insert_stmt->bindParam(':nome',         $get_name,                   PDO::PARAM_STR);  // Dando valores aos espaços declarado
        $insert_stmt->bindParam(':marca',        $get_brand,                  PDO::PARAM_STR);  // **
        $insert_stmt->bindParam(':descartavel',  $get_disposable,             PDO::PARAM_STR);  // **
        $insert_stmt->bindParam(':perecivel',    $get_perishable,             PDO::PARAM_STR);  // **
        $insert_stmt->bindValue(':categoria',    $get_category      ?? null,  PDO::PARAM_STR);  // **
        $insert_stmt->bindValue(':fornecedor',   $get_supplier      ?? null,  PDO::PARAM_INT);  // **
        $insert_stmt->bindValue(':validade',     $get_validity      ?? null,  PDO::PARAM_STR);  // **
        $insert_stmt->bindValue(':armazem',      $get_storage       ?? null,  PDO::PARAM_INT);  // **

        
        if ($insert_stmt->execute()) {
          echo '<script>alert("Produto cadastrado com sucesso!");</script>';                                // Alerta de sucesso
          //echo '<script>window.location.href = "../../pages/cadastros.html";</script>';                   // Hearder forçado
          echo '<script>window.location.href = "../../pages/cadastros.php";</script>';
          
        } else {
          echo '<script>alert("Erro ao cadastrar produto! Tente outro ou aguarde um momento.");</script>';  // Alerta de fracasso
          echo '<script>window.location.href = "../../pages/cadastros.html";</script>';                     // Hearder forçado
        }

      }

    }



    /**
     * Function responsavel em recarregar todos os dados do produto.
     * Recarregar, refazer comando SQL para adquirir dados atualizados sobre produto,
     * Além de encapsular todos os dados adiquiridos para uso futuros por outras functions.
     * 
     * @return void
     */
    private function reload_all_product() {

      $conn = database::connect();                                  // Conexão com o Banco de Dados.
      
      $query = "SELECT * FROM produto";                             // Montando Query SQL
      $stmt  = $conn->prepare($query);                              // Preparando 
      
      // Executando e encapsulando se houver uma execução.
      if ($stmt->execute()) {                                       

        
        $count_row = 0;                                             // Contador de linhas
        // Separando resultador por categoria
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {                                 
          
          $this->id[$count_row]             = $row['id_produto'];   // Encapsulando resultado por sua categoria
          $this->name[$count_row]           = $row['nome'];         // **
          $this->brand[$count_row]          = $row['marca'];        // **
          $this->supplier[$count_row]       = $row['fornecedor'];   // **
          $this->category[$count_row]       = $row['categoria'];    // **
          $this->disposable[$count_row]     = $row['descartavel'];  // **
          $this->perishable[$count_row]     = $row['perecivel'];    // **
          $this->validity[$count_row]       = $row['validade'];     // **
          $this->storage[$count_row]        = $row['armazem'];      // **
          $this->creation_date[$count_row]  = $row['atualizacao'];  // **

          $count_row++;                                             // Adição de linhas
        }

      // Caso não houver uma execução bem-sucedida.
      } else {

        // Exibir erro de falha de execução
      }

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
      $this->reload_all_product();                            

      // Montando Array com os valores encapsulado
      $all_info = array(
        'id'          => $this->id,             // Nomeando espaço do array equivalente ao valores recebidos
        'name'        => $this->name,           // **
        'brand'       => $this->brand,          // **
        'supplier'    => $this->supplier,       // **
        'category'    => $this->category,       // **
        'disposable'  => $this->disposable,     // **
        'perishable'  => $this->perishable,     // **
        'validity'    => $this->validity,       // **
        'storage'     => $this->storage,        // **
        'date_update' => $this->creation_date   // **
      );

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