<?php 

namespace App\Model;
require_once '../../vendor/autoload.php';
  

  use App\Model\ModelUser;

  use App\Model\DTO\BatchDTO;
  use App\Model\DTO\UserDTO;

  use App\Controller\ControllerBatch;


  class _Teste {



    public function modelUser_selectByID() {

      $user = new ModelUser();
      var_dump($user->selectByID(1));

    } 
  }

$teste = new _Teste();
$teste->modelUser_selectByID();
  
  

  

 


  
