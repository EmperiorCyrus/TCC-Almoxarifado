<?php
  namespace App\Controller;

  use App\Model\DTO\BatchDTO;
  //use App\Controller\ControllerBatch;

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

    $batch = new ControllerBatch();

    $action = $_POST['acao'];
    
    switch ($action) {

      case 'insert':

        $cod       = $_POST['cod'];

        // verifica se existe apenas números.
        if (ctype_digit($_POST['idnota'])) {
          $idnota = $_POST['idnota'];
        }

        $batchDTO = new BatchDTO($cod, $idnota);
        $batch->insert($batchDTO);





      break;


      case 'update':
      break;


      case 'delete':
      break;
    }






  } else {
    
    $batch = new ControllerBatch();
    $batchDTO = new BatchDTO('465132', 1);
    $batch->insert($batchDTO);
  }

