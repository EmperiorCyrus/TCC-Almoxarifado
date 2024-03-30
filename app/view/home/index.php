<!-- CONFIGURAÇÃO DA VIEW -->
<div id="imagem-de-fundo"></div>
<?php
$title = "Home";
$active = "home";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
$navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
$footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA
?>

<?php include_once "app/view/components/head.php" ?>

<!-- Título -->
<h1 class="text-center text-xl font-weight-bold">S.G.A</h1>
<p class="text-center text-lg font-weight-bold">Sistema de Gerenciamento de Almoxarifado</p>
<!-- TODO: Mudar esse texto aqui -->
<div class="d-flex justify-content-center mb-4">
  <div class="w-50 text-center border-bottom border-bottom-1 pb-4 text-gray font-weight-bold">
    📦 Maximize a <span class="text-primary">eficiência</span> do seu almoxarifado com o nosso Sistema de Gerenciamento de Almoxarifado!
  </div>
</div>

<!-- Cards: Usado apenas para gerar os cards com mesmo estilo porem dados diferentes -->
<?php
$cards = [
  [
    "name" => "Produtos",
    "url" => "/produtos",
    "icon" => "bi bi-bag-fill"
  ],
  [
    "name" => "Notas",
    "url" => "/notas",
    "icon" => "bi bi-sticky-fill"
  ],
  [
    "name" => "Lotes",
    "url" => "/lotes",
    'icon' => "bi bi-box-seam-fill"
  ],
  [
    "name" => "Entradas",
    "url" => "/entradas",
    "icon" => "bi bi-door-open-fill"
  ],
  [
    "name" => "Saídas",
    "url" => "/saidas",
    "icon" => "bi bi-door-closed-fill"
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