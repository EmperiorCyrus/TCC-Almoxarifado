<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'caminho/para/o/PHPMailer/src/PHPMailer.php';
require 'caminho/para/o/PHPMailer/src/Exception.php';
require 'caminho/para/o/PHPMailer/src/SMTP.php';


class mail_box {


  public function send_email($info_user) {

    self::key();

    $user_name = $_ENV['EMAIL_USERNAME']; // Email
    $password  = $_ENV['EMAIL_PASSWORD']; // Senha


    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();                    // Configurando protocolo para SMTP
      $mail->Host = 'smtp.gmail.com';     // Servidor SMTP
      $mail->SMTPAuth = true;             // Definindo autenticação SMTP
      $mail->Username = $user_name;       // Email receptor
      $mail->Password = $password;        // Senha correspondente
      $mail->SMTPSecure = 'tls';          // Protocolo de segurança para conexão com o servidor
      $mail->Port = 587;                  // Porta do servidor

    } catch (Exception $e) {

      // Definir mensagem de erro.
    }
  }

  

  private function key() {

    $path = "../../support.env";

    // Se o arquivo não for corrompido
    if (file_exists($path)) {

      $lines = file($path,                                        // Salvando conteúdo do arquivo na variavel
                    FILE_IGNORE_NEW_LINES |                       // Impedindo quebra de linha no final do arquivo
                    FILE_SKIP_EMPTY_LINES);                       // Ignorando linhas em brancas.

      // pecorrendo linha por linha
      foreach ($lines as $line) {

        // Verifica se $line possui um "=" e se não possui um # no começo da string.
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {

          list($key, $value) = explode('=', $lines, 2);           // Salvando as duas frações do explode.

          // Verificando se a chave já não foi definida nas variaveis super-globais.
          if (!array_key_exists($key, $_ENV) && !array_key_exists($key, $_SERVER)) {

            $_ENV[$key] = $value;                                 // Salvando chave para superglobal para ambiente
            $_SERVER[$key] = $value;                              // **       **    **   **          para servidor
          }

        }

      }

    }

  }


}