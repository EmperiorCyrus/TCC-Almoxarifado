<?php

namespace App\Controller;

class HomeController
{
  public function index()
  {
    return view('resources/views/home.php');
  }

  public function create()
  {
    var_dump('teste');
  }

  public function admin()
  {
    var_dump('admin');
  }

  public function adminCreate()
  {
    var_dump('criou');
  }

  public function adminSearch($id)
  {
    var_dump($id);
  }

  /**
   * TODO: REMOVER PORQUE ISSO NÃO DEVERIA ESTAR AQUI
   * É APENAS POR RAZÕES DE TESTES O PERFIL SER AQUI
   *
   * @return void
   */
  public function perfil()
  {
    return view("resources/views/perfil.php");
  }

  /**
   * TODO: REMOVER PORQUE ISSO NÃO DEVERIA ESTAR AQUI
   * É APENAS POR RAZÕES DE TESTES O INDEX DAS NOTAS SER AQUI
   *
   * @return void
   */
  public function notas()
  {
    return view("resources/views/note/index.php");
  }
}