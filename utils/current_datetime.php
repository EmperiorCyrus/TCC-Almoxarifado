<?php
  //======================================================================
  // FUNÇÂO - DATA       
  //======================================================================

  namespace Utils;

  use DateTime;

  date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso hórario do Brasil.
  setlocale(LC_TIME, 'pt_BR.utf8');               // Definindo idioma para português BR.



  /**
   * Function responsável pelo tempo/periodo atual.
   * Altera e retorna formato da exibição de tempo conforme recebido no parameto.
   * 
   * @param string    - $format_sent
   * 
   * @return string   - $current_day_formated
   */
  function current_datetime($format_sent) {

    $current_day = new Datetime();                                // Instânciando função de Data PHP
    $current_day_formated = $current_day->format($format_sent);   // Formata data

    return $current_day_formated;                                 // Retorna tempo.
  }
  
?>