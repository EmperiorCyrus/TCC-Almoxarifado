<!-- CONFIGURAÇÃO DA VIEW -->
<?php
  $active = "home";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
  $navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
  $footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA
?>

<?php include_once "app/view/components/head.php" ?>

<!-- Título -->
<h1 class="text-center text-xl font-weight-bold">Gerenciamento de almoxarifado</h1>
<!-- TODO: Mudar esse texto aqui -->
<p class="text-sm font-italic text-center border-bottom border-bottom-1 pb-4 text-gray font-weight-bold">Lorem ipsum
  dolor sit amet,
  consectetur
  adipisicing elit. Exercitationem
  veritatis
  ducimus eos sapiente nam earum impedit? Quos dolore a dolor.</p>
<!-- Cards: Usado apenas para gerar os cards com mesmo estilo porem dados diferentes -->
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
    <!-- Cards na view -->
    <?php foreach ($cards as $card) { ?>
      <div class="col-md-3">
        <?php include "app/view/components/menu-card.php"; ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php include_once "app/view/components/footer.php" ?>