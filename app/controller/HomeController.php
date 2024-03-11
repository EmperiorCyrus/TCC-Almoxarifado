<?php

namespace App\Controller;

class HomeController
{
  public function index()
  {
    return view('app/view/home/index.php');
  }

  /**
   * É APENAS POR RAZÕES DE TESTES O PERFIL SER AQUI
   *
   * @return void
   */
  public function perfil()
  {
    return view("app/view/perfil.php");
  }
}