<?php
//======================================================================
// MODEL - ENTRADA
//======================================================================
namespace App\Model;
use Core\DataBase;
use PDO;
use Utils;
use PDOException;
use Exception;
use Utils\write_log;

require_once('../../core/database.php');
require_once('../../utils/write_log.php');
/**
 * Class responsável pela manipulação geral de toda entrada.
 * Usando sintaxe SQL com o método PDO nas funções de manipulações.
 * 
 * @author Gustavo Cavalcante - Guhghamer@gmail.com
 * @version 1.0
 */
class entrance {

    private $conn;
    private $amount; //Quantidade da entrada
    private $validity; // Validade do produto
    private $value; //Valor monetario da carga


    /**
     * Contruct responsável em iniciar conexão com o Banco de Dados.
     */
    public function __construct() {
        $this->conn = DataBase::connect(); 
      }

    
    /**
     * Function responsável em criar um novo lote.
     * Além de criar, ele registra ações relacionada a ela.
     * 
     * @param int        $idlote $amount $validity $value
     * 
     * @return int      0|1 - Boa ou má execução
     */
    public function new_entrance($idlote,$amount,$validity,$value) { 
             
        // Analiza execuções dentro da função de possiveis erros e falha.
        try {
            // Query para verificar a existencia da id referente ao id do lote.
            $query_select = "SELECT id FROM entrada WHERE idlote = :idlote";                        // Query para identificar ID correspondente ao id do lote passado.
            $select_stmt = $this->conn->prepare($query_select);   
            $result = $select_stmt;                              // Preparando sintaxe SQL.
            $select_stmt->bindParam(':idlote',      $idlote,     PDO::PARAM_INT);   // Dando valor ao espaço declarado.
    
                // Verificando se a execução foi bem-sucedida.
                if ($select_stmt->execute()) {
        
                    // Verificando se a resposta da query é apenas 1.
                    if ($select_stmt->rowCount() == 1) {

                    $query_insert = "INSET FROM entrada(quantidade,validade,valor) VALUE(:amount, :validity, :value)";
                    $insert_stmt = $this->conn->prepare($query_insert);                                 // Preparando sintaxe SQL.
                    $insert_stmt->bindParam(':amount',          $amount,         PDO::PARAM_INT);       // Dando valor ao espaço declarado.
                    $insert_stmt->bindParam(':validity',        $validity,       PDO::PARAM_INT);       // Dando valor ao espaço declarado.
                    $insert_stmt->bindParam(':value',           $value,          PDO::PARAM_INT);       // Dando valor ao espaço declarado. 
                
                if($insert_stmt->execute()) {
                    
                    $text = "[ CREATE ][ ENTRANCE ] - [ ENTRANCE: {$idlote} ID do lote]";  // Salva topico para log,
                    $log = write_log::write($text, "register");     // Chama função para registrar tópico.        
                }
                // Em caso de não ter resultado ou ter mais de um.
                
                }else {
                    return 1;
                }
            }
        }  catch (PDOException $error_pdo) {

            $text = ["[ ERROR ][ BD ] - [ ENTRANCE / CREATE ]"];                 // Salva topicos para log
            $log = write_log::write($text, "error-pdo", $error_pdo);                        // Chamando função para escrever erro do BD no log
            return 1;                                                         // Alerta controller de uma má execução com "1".
    
          //> Tratativa de erro relacionado ao Sistema.
          } catch (Exception $error_system) {
    
            $text = ["[ ERROR ][ SYSTEN ]","[ MODEL ][ ENTRANCE / CREATE ]"];    // Salva topicos para log
            $log = write_log::write($text, "error-system", $error_system);                  // Chamando função para escrever erro de sistema no log
            return 1;                                                         // Alerta controller de uma má execução com "1".
          }
        
    }


}


