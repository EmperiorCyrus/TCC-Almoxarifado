<?php
  //======================================================================
  // MODEL - ENTRADA
  //======================================================================
  namespace App\Model;

  use App\Model\DTO\EntranceDTO;
  use Core\DataBase;
  use PDO;

  use PDOException;
  use Exception;
  use Utils\write_log;
  /**
   * Class responsável pela manipulação geral de toda entrada.
   * Usando sintaxe SQL com o método PDO nas funções de manipulações.
   * 
   * @author Gustavo Cavalcante - Guhghamer@gmail.com
   * @version 1.0
   */
  class ModelEntrance{

    private $amount; //Quantidade da entrada
    private $validity; // Validade do produto
    private $value; //Valor monetario da carga

    
    private $conn;                         // Conexão com o BD
    public static  $updade_class = false;  // Status de verificação de propriedade. 


    /**
     * Contruct responsável em iniciar conexão com o Banco de Dados.
     */
    public function __construct() {
        $this->conn = Database::connect(); 
      }

    
    /**
     * Function responsável em criar um novo lote.
     * Além de criar, ele registra ações relacionada a ela.
     * 
     * @param int        $idlote $amount $validity $value
     * 
     * @return int      0|1 - Boa ou má execução
     */
    public function insert($id_batch_sent,$amount_sent,$validity_sent,$value_sent) { 
             
      // Analiza execuções dentro da função de possiveis erros e falha.
      try {
        // Query para verificar a existencia da id referente ao id do lote.
        $query_select = "SELECT id FROM entrada WHERE idlote = :idlote";                        // Query para identificar ID correspondente ao id do lote passado.
        $select_stmt = $this->conn->prepare($query_select);                                 // Preparando sintaxe SQL.
        $select_stmt->bindParam(':idlote',      $id_batch_sent,     PDO::PARAM_INT);   // Dando valor ao espaço declarado.
  
        // Verificando se a execução foi bem-sucedida.
        if ($select_stmt->execute()) {

          // Verificando se a resposta da query é apenas 1.
          if ($select_stmt->rowCount() == 1) {

          $query_insert = "INSET FROM entrada(quantidade,validade,valor) VALUE(:amount, :validity, :value)";
          $insert_stmt = $this->conn->prepare($query_insert);                                 // Preparando sintaxe SQL.
          $insert_stmt->bindParam(':amount',          $amount_sent,         PDO::PARAM_INT);       // Dando valor ao espaço declarado.
          $insert_stmt->bindParam(':validity',        $validity_sent,       PDO::PARAM_INT);       // Dando valor ao espaço declarado.
          $insert_stmt->bindParam(':value',           $value_sent,          PDO::PARAM_INT);       // Dando valor ao espaço declarado. 
        
          if($insert_stmt->execute()) {
                  
            $text = "[ CREATE ][ ENTRANCE ] - [Quantidade - {$amount_sent}] - [Validade - {$validity_sent}] - [Valor - {$value_sent}]";  // Salva topico para log,
            $log = write_log::write($text, "register");     // Chama função para registrar tópico.        
          }
            // Em caso de não ter resultado ou ter mais de um.
            
        }else {
            return 1;
        } 
      }
        } catch (PDOException $error_pdo) {

          $text = ["[ ERROR ][ BD ] - [ ENTRANCE / CREATE ]"];                 // Salva topicos para log
          $log = write_log::write($text, "error-pdo", $error_pdo);                        // Chamando função para escrever erro do BD no log
          return 1;                                                         // Alerta controller de uma má execução com "1".
    
        //> Tratativa de erro relacionado ao Sistema.
        } catch (Exception $error_system) {
  
          $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / CREATE ]"];    // Salva topicos para log
          $log = write_log::write($text, "error-system", $error_system);                  // Chamando função para escrever erro de sistema no log
          return 1;                                                         // Alerta controller de uma má execução com "1".
        }
      return 0;
    }

    /** 
     * Função responsavel por atualizar a entrada 
     * 
    */
    private function update($id_entrance_sent, $new_amount, $new_validity, $new_value,$nome_produto,$date_entrance_sent) {
        try {

            // Querys para obter ID da nota antes de ser atualizado
            $query = "SELECT identrada FROM entrada WHERE data_entrada = :data_entrada";                          // Query para buscar ID da entrada relacionada
            $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
            $stmt->bindParam(':data_entrada',  $date_entrance_sent,       PDO::PARAM_STR);                        // Dando valor ao espaço declarado
            
            // Verificando se há uma boa execução.
            if ($stmt->execute()) {
    
              $result = $stmt->fetch(PDO::FETCH_ASSOC);                                                     // Obtendo resultado
              $old_id_entrance = $result['identrada'];  

               // Query e manilação para atualização da entrada.                                                  // Salvando ID da nota no resultado
              $update_query = " UPDATE entrada
              SET quantidade = :new_amount, validade = :new_validity, valor = :new_value 
              WHERE identrada = :id_entrance_sent";
              $update_stmt  = $this->conn->prepare($update_query);                                        // Preparando sintaxe SQL
              $update_stmt->bindParam(':id_entrance_sent',      $id_entrance_sent,                    PDO::PARAM_INT);  // Dando valores aos espaços declarado.
              $update_stmt->bindValue(':new_amount',            $new_amount         ??null ,          PDO::PARAM_INT);  //Dando valor ao espaço declarado
              $update_stmt->bindValue(':new_validity',          $new_validity       ??null ,          PDO::PARAM_STR);  //Dando valor ao espaço declarado
              $update_stmt->bindValue(':new_value',             $new_value          ??null ,          PDO::PARAM_INT);  //Dando valor ao espaço declarado
              // Verifica se a execução é bem-sucedida.
              if ($update_stmt->execute()) {
    
                $text = "[ UPDATE ][ ENTRANCE ] - [Entrada - {$old_id_entrance}]- [Quantidade - {$new_amount}] - [Validade - {$new_validity}] - [Valor - {$new_value}] ";                         // Salva topicos para log
                $log = write_log::write($text, "register");                                                             // Chamando função para registrar log
                
                self::$updade_class = false;                                                         // Avisando que a class não está atualizado
              }
            }
    
          //> Tratativa de erro relacionado ao Banco de Dados.
          } catch (PDOException $error_pdo){
    
            $text = ["[ ERROR ][ BD ] - [ ENTRANCE / UPDATE ]"];                   // Salva topicos para log
            $log = write_log::write($text, "error-pdo", $error_pdo);                            // Chamando função para escrever erro no BD no log
            return 1;                                                             // Alerta controller de uma má execução com "1".
          
    
          //> Tratativa de erro relacionado ao Sistema.
          } catch (Exception $error_systen){
    
            $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / UPDATE ]"];      // Salva topicos para log
            $log = write_log::write($text, "error-system", $error_systen);                      // Chamando função para escrever erro de sistema no log
            return 1;                                                             // Alerta controller de uma má execução com "1".
          }
    
          // Alerta controller de uma boa execução com "0".
          return 0;                                               
    }

    private function self_update($id_entrance_sent,$quantidade_saida) {
      try {

         // Query para verificar a existencia da id referente ao id do lote.
          $query_select = "SELECT id FROM entrada WHERE idlote = :idlote";                        // Query para identificar ID correspondente ao id do lote passado.
          $select_stmt = $this->conn->prepare($query_select);                                 // Preparando sintaxe SQL.
          $select_stmt->bindParam(':idlote',      $id_entrance_sent,     PDO::PARAM_INT);   // Dando valor ao espaço declarado.
    
        // Verificando se há uma boa execução.
        if ($select_stmt->execute()) {

          $result = $select_stmt->fetch(PDO::FETCH_ASSOC);                                                     // Obtendo resultado
          $old_id_entrance = $result['identrada'];  

           // Query e manilação para atualização da entrada.                                                  // Salvando ID da nota no resultado
          $update_query = " UPDATE entrada
          SET quantidade = quantidade - :quantidade_saida 
          WHERE identrada = :id_entrance_sent";
          $update_stmt  = $this->conn->prepare($update_query);                                        // Preparando sintaxe SQL
          $update_stmt->bindParam(':id_entrance_sent',      $old_id_entrance,                    PDO::PARAM_INT);  // Dando valores aos espaços declarado.
          $update_stmt->bindParam(':quantidade_saida',      $quantidade_saida,                    PDO::PARAM_INT);  // Dando valores aos espaços declarado.
          // Verifica se a execução é bem-sucedida.
          if ($update_stmt->execute()) {

            $text = "[ UPDATE ][ ENTRANCE ] - [Entrada - {$old_id_entrance}]";                         // Salva topicos para log
            $log = write_log::write($text, "register");                                                             // Chamando função para registrar log
            
            self::$updade_class = false;                                                         // Avisando que a class não está atualizado
          }
        }

      //> Tratativa de erro relacionado ao Banco de Dados.
      } catch (PDOException $error_pdo){

        $text = ["[ ERROR ][ BD ] - [ ENTRANCE / UPDATE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);                            // Chamando função para escrever erro no BD no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_systen){

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / UPDATE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_systen);                      // Chamando função para escrever erro de sistema no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      }

      // Alerta controller de uma boa execução com "0".
      return 0;                            
    }
    public function delete_entrance($id_entrance_sent) {
      try {
          // Querys para obter ID da nota antes de ser atualizado
          $query = "SELECT identrada FROM entrada WHERE identrada = :id_entrance_sent";                          // Query para buscar ID da entrada relacionada
          $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
          $stmt->bindParam(':id_entrance_sent', $id_entrance_sent,       PDO::PARAM_INT);                        // Dando valor ao espaço declarado
          
          // Verificando se há uma boa execução.

          if ($stmt->execute()) {
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);                                                     // Obtendo resultado
            $old_id_entrance = $result['identrada'];  

            $delete_query = "DELETE * FROM entrada WHERE identrada = :identrada";
            $delete_stmt = $this->conn->prepare($delete_query);
            $delete_stmt->bindParam('identrada',$old_id_entrance,       PDO::PARAM_INT);  
          // Verifica se a execução é bem-sucedida.
          if ($delete_stmt->execute()) {
    
            $text = "[ DELETE ][ ENTRANCE ] - [Entrada - {$old_id_entrance}]";                         // Salva topicos para log
            $log = write_log::write($text, "register");                                                             // Chamando função para registrar log
            
            self::$updade_class = false;                                                         // Avisando que a class não está atualizado
          }
        }
  
      } catch (PDOException $error_pdo){
    
        $text = ["[ ERROR ][ BD ] - [ ENTRANCE / DELETE ]"];                   // Salva topicos para log
        $log = write_log::write($text, "error-pdo", $error_pdo);                            // Chamando função para escrever erro no BD no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      

      //> Tratativa de erro relacionado ao Sistema.
      } catch (Exception $error_systen){

        $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / DELETE ]"];      // Salva topicos para log
        $log = write_log::write($text, "error-system", $error_systen);                      // Chamando função para escrever erro de sistema no log
        return 1;                                                             // Alerta controller de uma má execução com "1".
      }

      // Alerta controller de uma boa execução com "0".
      return 0;                                   
    }

  public function get_all_entrance($identrance,$get_sent) {
    try { 
        // Querys para obter ID da nota antes de ser atualizado
        $query = "SELECT identrada FROM entrada WHERE identrada = :id_entrance_sent";                          // Query para buscar ID da entrada relacionada
        $stmt  = $this->conn->prepare($query);                                                          // Preparando sintaxe
        $stmt->bindParam(':id_entrance_sent', $id_entrance_sent,       PDO::PARAM_INT);                        // Dando valor ao espaço declarado
        
        // Verificando se há uma boa execução.
        if ($stmt->execute()) {
    
          $result = $stmt->fetch(PDO::FETCH_ASSOC);                                                     // Obtendo resultado
          $old_id_entrance = $result['identrada'];  

          $delete_query = "SELECT * FROM entrada WHERE identrada = :identrada";
          $delete_stmt = $this->conn->prepare($delete_query);
          $delete_stmt->bindParam(':identrada', $old_id_entrance,       PDO::PARAM_INT);
        // Verifica se a execução é bem-sucedida.
        if ($delete_stmt->execute()) {
  
          $text = "[ GET ][ ENTRANCE ] - [Entrada - {$old_id_entrance}]";                         // Salva topicos para log
          $log = write_log::write($text, "register");                                                             // Chamando função para registrar log
          
          self::$updade_class = false;                                                         // Avisando que a class não está atualizado
        }
      }

    } catch (PDOException $error_pdo){
  
      $text = ["[ ERROR ][ BD ] - [ ENTRANCE / GET ]"];                   // Salva topicos para log
      $log = write_log::write($text, "error-pdo", $error_pdo);                            // Chamando função para escrever erro no BD no log
      return 1;                                                             // Alerta controller de uma má execução com "1".
    

    //> Tratativa de erro relacionado ao Sistema.
    } catch (Exception $error_systen){

      $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / GET ]"];      // Salva topicos para log
      $log = write_log::write($text, "error-system", $error_systen);           // Chamando função para escrever erro de sistema no log
      return 1;                                                             // Alerta controller de uma má execução com "1".
    }

    // Alerta controller de uma boa execução com "0".
    return 0;                                   

  }  
}


