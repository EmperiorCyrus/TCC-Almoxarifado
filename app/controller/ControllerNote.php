<?php

namespace App\Controller;

class ControllerNote
{
  /**
   * Método que retorna a view de listagem de notas
   *
   * @return void
   */
  public function index()
  {
    return view('app/view/note/index.php');
  }

  /**
   * Método que retorna a view de criação de notas
   *
   * @return void
   */
  public function create()
  {
    return view('app/view/note/insert.php');
  }
}