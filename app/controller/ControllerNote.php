<?php

namespace App\Controller;

use App\Model\DTO\NoteDTO;
use App\Model\ModelNote;

class ControllerNote
{

  private ModelNote $noteModel;

  public function __construct()
  {
      $this->noteModel = new ModelNote();
  }

  /**
   * Método que retorna a view de listagem de notas
   *
   * @return void
   */
  public function index()
  {
    $notas = $this->noteModel->selectAll();

    return view('app/view/note/index.php', ["notas" => $notas]);
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