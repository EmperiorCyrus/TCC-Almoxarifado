<?php
  //======================================================================
  // FUNÇÂO EXTENÇÃO para MODEL_INVOICE - PATH LOG         
  //======================================================================

  namespace Utils;



  /**
   * Function responsável em criar o diretorio do registro.
   * Analizando a ausência das pastas, ele cria conforme a necessidade
   * com nomeclatura com indicativa ao ano e mês.
   * 
   * @return string   $path_month
   */
  function create_path_log() {

    $path_log       = "../../logs";                 // Recebendo caminho do pasta receptora de registros
    $current_year   = date('Y');                    // **        ano atual
    $current_month  = date('F');                    // **        mês atual



    $path_year = $path_log. '/'. $current_year;     // Concatenando ano ao caminho
    // Verifica se essa pasta não existe
    if (!is_dir($path_year)) {

      mkdir($path_year, 0777, true);                // Criando pasta verificada
    }


    echo("<br>{$path_year}<br>");
    echo("<br>{$current_month}<br>");
    return $path_year.'/Register_'. $current_month. '.log';              // Retornado caminho final
  }

?>