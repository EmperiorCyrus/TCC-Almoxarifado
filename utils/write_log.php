<?php
//======================================================================
// FUNCTION - ESCREVE ERRO
//======================================================================
  namespace Utils;
  //use PDOException;
  //use Exception;
  use function Utils\create_path_log;
  use function Utils\current_datetime;
  
  require_once('current_datetime.php');
  require_once('create_path_log.php');



  /**
   * 
   */
  class write_log {


    /**
     * @param string|array    $message_sent
     * @param string          $type
     * @param mixed           $error_sent       - Não é obrigatório
     */
    static function write($message_sent, $type, $error_sent = null) {

      $date    = current_datetime('[d/m/Y] D - H:i:s - ');                                                  // Obtem a data atual numa formação expecifica

      

      // Seleciona tipo de escrita para determinada ação.
      switch ($type) {

        // Caso o registro seja relacionado ao erro de sistema.
        case 'error-system':

          $message = $date.  "[ ERROR ] ---> ". $message_sent[0]. $error_sent->getMessage(). PHP_EOL.                       // Concatena data e registra erro na variável
          '.                             [ ERROR ] ---> '. $message_sent[1]. ' - [ LINE - '. $error_sent->getLine(). ' ]'.  // Informa local do erro e a linha.
          ' - '. $error_sent->getFile();                                                                                    // **
          break;

        // Caso o registro seja relacionado ao erro do PDO.
        case 'error-pdo':

          $message = $date. "[ ERROR ] ---> ". $message_sent[0]. ' - '. $error_sent->getMessage();                           // Registra erro na variável
          break;

        // Caso o registro seja relacionado a manipulação do BD.
        case 'register':

          $message = $date. $message_sent;                                                                // Registro da manipulação na variavel
          break;

      }

      $path = create_path_log();                                                                          // Obtendo caminho para a pasta
      file_put_contents($path, $message. PHP_EOL, FILE_APPEND);                                           // Indica caminho e mensagem a ser escrito
      //-                                                                                                 // FILE_APPEND - Impede que o conteúdo seja substituido, reescrevendo no final.
    }
  }