<?php

  /**
   * Class responsável pela criptografia do sistema.
   * Criptografias e descritografias feitas com biblioteca Openssl do PHP.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class mask {

    private static $key     = "portugal";     // Chave da criptografia
    private static $method  = 'aes-256-cbc';  // Método   - Advanced Encryption Standard (AES)
                                              // Tamanho  - 256 bits
                                              // Operação - Cipher Block Chaining (CBC)


    /**
     * Function criptografa uma string enviada pelo sistema.  
     * Codifica string recebida para retornar criptografada.
     * 
     * @param string $string_sent - texto descriptografado.
     * 
     * @return string             - texto criptografado.
     */              
    public function encrypt($string_sent) {

      $launcher = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$method));     // Gera um IV aleatorio com o mesmo tamanho do método (AES) em bytes.
      $encrypted = openssl_encrypt($string_sent, self::$method, self::$key, 0, $launcher);  // Criptografa texto usando metodos e chaves citados nos atributos.

      return base64_encode($launcher . $encrypted);                                         // retornando o resultado da 2º criptografia concatenado com o IV gerado.
    }



    /**
     * Function descriptografa uma string previamente criptografada pelo sistema.
     * Decodifica, extrai e remove a criptografia para retornar o texto original.
     * Essa função também pode descriptografar strings criptografadas externamente
     * que sigam os mesmos métodos e operações.
     * 
     * @param string $string_sent - texto criptografado.
     * 
     * @return string             - texto descriptografado.
     */
    public function decrypt($string_sent) {

      $decrypted = base64_decode($string_sent);                                             // Decodificando texto para a forma binaria original e representando em ASCII usando esquema Base64.
      $size_launcher = openssl_cipher_iv_length(self::$method);                             // Obtendo o tamanho em bytes do bloco de criptografia usado (AES).
      $launcher = substr($decrypted, 0, $size_launcher);                                    // Extraindo o IV (CBC) da representação da criptografia.
      $clear_text = substr($decrypted, $size_launcher);                                     // Obtendo a representação criptografada sem o IV.

      
      return openssl_decrypt($clear_text, self::$method, self::$key, 0, $launcher);         // Retornando o resultado da descriptografia usando a biblioteca openssl.
    }

  }

  /*
  $teste = new mask();
  $teste2 = $teste->encrypt("wesley portugal santana");
  $teste3 = $teste->decrypt($teste2);

  echo($teste2. "<br>". $teste3);
  */
?>