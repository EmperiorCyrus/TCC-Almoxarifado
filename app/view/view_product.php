<?php 
  require_once("../app/controller/show_product.php");
  //require_once("../controller/show_product.php");
  
  $info = new show_product();
?>

  <form action="#" method="">
    <input type="text" placeholder="Search">
    <select name="filtro-opcao" required>
      <option>- campo -</option>
      <option value="nome">Nome</option>
      <option value="marca">Marca</option>
      <option value="fornecedor">Fornecedor</option>
      <option value="categoria">Categoria</option>
    </select>
  </form>
  <table border="2">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Marca</th>
        <th>Fornecedor</th>
        <th>Categoria</th>
        <th>Armazem</th>
        <th>Preço Un.</th>
        <th>Preço Total</th>
        <th>Descartável</th>
        <th>Perecivel</th>
        <th>Validade</th>
        <th>Data Criação</th>
      </tr>
    </thead>
    <tbody>

    <?php
      $info->show_all_product();
    ?>

    </tbody>
  </table>
