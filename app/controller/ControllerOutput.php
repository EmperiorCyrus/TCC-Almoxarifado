<?php

namespace App\Controller;

class ControllerOutput
{

  /**
   * Método que retorna a view de criação de saídas
   *
   * @return void
   */
  public function create()
  {
    return view('app/view/output/insert.php');
  }
}