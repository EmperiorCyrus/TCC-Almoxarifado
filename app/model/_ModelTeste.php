<?php 

  namespace App\Model;

  use App\Model\DTO\BatchDTO;
  use App\Controller\ControllerBatch;
  

  $batch = new ControllerBatch();
  $batchDTO = new BatchDTO(52);
  $teste = $batch->insert($batchDTO);

 


  
