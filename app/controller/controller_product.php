<?php
namespace App\Controller;
//======================================================================
// CONTROLLER - PRODUTO
//======================================================================
session_start();
require_once("../model/model_product.php");
require_once("../../assets/php/remove_accent.php");
require_once('../../assets/php/current_datetime.php');

// Verificando se há requisição via POST.
if($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Valores que são obrigatorio:
  $name       = $_POST['nome'];                               // Obtendo Nome
  $brand      = $_POST['marca'];                              // Obtendo Marca
  $validity   = $_POST['validade'];                           // Obtendo Validade

  // Formantando / Corrigindo:
  $name_clean  = remove_accent($name);                        // Removendo caracteres especias de "name".
  $brand_clean = remove_accent($brand);                       // Removendo caracteres especias de "brand".

  $name_lower  = strtolower($name_clean);                     // Alterando NAME para minusculo
  $brand_lower = strtolower($brand_clean);                    // Alterando BRAND ***


  $datetime_now = new DateTime();                             // Pegando a data atual do sístema.
  $date_update = $datetime_now->format('Y-m-s H:i:s');        // Formantando a data.

  // Verificando se existe dados, criando variaveis e escrevendo valor comforme as opções:
  if (isset($_POST['descartavel'])) { $disposable = "sim";}   // Se houver dados, rescreverá "sim";
  else { $disposable = null;}                                 // Se não houver, define: "null"

  // **
  if (isset($_POST['perecivel'])) {

    $perishable = "sim";                                      // Se houver dados, rescreverá "sim";
    $validity = $_POST['validade'];                           // Obtem valor do POST.

    // Verifica se validade é uma string e que segue o padrão "AAAA-MM-DD".
    if (is_string($validity) && preg_match('/\d{4}-\d{2}-\d{2}/', $validity)) {
      // Se 
      $validity = DateTime::createFromFormat('Y-m-d', $validity)->format('Y-m-d');
    }
  } else {
    $perishable = null;                                       // Se não houve perecivel, define: "null".
    $validity = null;
  }


  $_SESSION['erro'] = $date_update;

  $product = new product();
  $product->new_product($name_lower, $brand_lower, $disposable, $perishable, $validity);




}



?>