<?php

namespace App\Controller;

use App\Model\DTO\OutputDTO;
use App\Model\ModelOutput;

class ControllerOutput
{

  private ModelOutput $outputModel;

  public function __construct()
  {
      $this->outputModel = new ModelOutput();
  }

  /**
   * Método que retorna a view de listagem de notas
   *
   * @return
   */
  public function index()
  {
    $saidas = $this->outputModel->selectAll();
    return view('app/view/output/index.php', ["saidas" => $saidas]);
  }

  /**
   * Método que retorna a view de criação de saídas
   *
   * @return
   */
  public function create()
  {
    return view('app/view/output/insert.php');
  }
}