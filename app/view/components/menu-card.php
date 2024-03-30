<!-- Link com a rota para onde o card leva, se não houver um link então ele leva pra home para evitar erros -->
<a href="<?= isset($card['url']) ? $card['url'] : '/' ?>">
  <div class="d-flex flex-row align-items-center card custom-sga-animation-hover bg-blue w-100 p-4 shadow-sm">
    <!-- Conteúdo dinâmico do card -->
    <i class="<?= isset($card['icon']) ? $card['icon'] : "" ?> pr-2"></i>
    <?= isset($card['name']) ? $card['name'] : "Card" ?>
  </div>
</a>