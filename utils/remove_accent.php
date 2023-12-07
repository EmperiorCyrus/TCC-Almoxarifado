<?php

  /**
   * Function responsável em remover acentos.
   * Usando uma função nativa, 'strtr', do PHP e uma Array pré moldada,
   * a string recebida será alterada para sua versão sem os caracteres especiais
   * identificado pela função 'strtr'.
   * 
   * @param string    $string a ser formatado
   * @return string   $string sem acentos
   */
  function remove_accent($string) {

    // Array possuindo um mapeamento de caracteres com acentos.
    $accents = array (
      'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A',
      'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a',
      'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
      'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
      'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',
      'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
      'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O',
      'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o',
      'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U',
      'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u',
      'Ý'=>'Y',
      'ý'=>'y', 'ÿ'=>'y',
      'Ñ'=>'N',
      'ñ'=>'n',
      'Ç'=>'C',
      'ç'=>'c',
    );

    // Executando a alteração e retornando o resultado.
    return strtr($string, $accents);
  }

  // Editado: 15/11/2023
?>