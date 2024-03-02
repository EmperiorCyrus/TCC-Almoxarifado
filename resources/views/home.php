<?php $active = "home" ?> <!-- CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGIAN ATUAL -->
<?php include_once "components/head.php" ?>
<h1 class="text-center text-xl font-weight-bold">Gerenciamento de almoxarifado</h1>
<p class="text-sm font-italic text-center border-bottom border-bottom-1 pb-4 text-gray font-weight-bold">Lorem ipsum
  dolor sit amet,
  consectetur
  adipisicing elit. Exercitationem
  veritatis
  ducimus eos sapiente nam earum impedit? Quos dolore a dolor.</p>
<!-- index.php -->
<?php
$cards = [
  [
    "name" => "Produtos",
    "url" => "/"
  ],
  [
    "name" => "Estoques",
    "url" => "/"
  ],
  [
    "name" => "Perfil",
    "url" => "/perfil"
  ],
  [
    "name" => "Notas",
    "url" => "/notas"
  ],
];
?>
<div class="container">
  <div class="row d-flex justify-content-center">
    <?php foreach ($cards as $card) { ?>
      <div class="col-md-3">
        <?php include "components/menu-card.php"; ?>
      </div>
    <?php } ?>
  </div>
</div>


<?php include_once "components/footer.php" ?>