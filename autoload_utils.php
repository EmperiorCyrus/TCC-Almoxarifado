<?php
  //======================================================================
  // AUTOLOAD para FUNÇÔES em UTILS
  //======================================================================


  // Função capaz de capturar e carregar functions ao ser chamado.
  spl_autoload_register(function ($function_name) {

    $function_path = __DIR__. '/utils/'. $function_name. '.php';  // Obtendo caminho matriz para as functions

    // Verifica se o arquivo existe
    if (file_exists($function_path)) {

      include_once $function_path;                                // Incluindo função relacionado
    }
    
  });

?>