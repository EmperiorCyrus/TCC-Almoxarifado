<?php

namespace App\Controller;

class HomeController
{
  public function index()
  {
    return view('resources/views/teste.php');
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
}