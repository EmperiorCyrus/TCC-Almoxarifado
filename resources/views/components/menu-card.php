<!-- Link com a rota para onde o card leva, se não houver um link então ele leva pra home para evitar erros -->
<a href="<?= isset($card['url']) ? $card['url'] : '/' ?>">
  <div class="card custom-sga-animation-hover bg-blue w-100 p-4 shadow-sm">
    <!-- Conteúdo dinâmico do card -->
    <?= isset($card['name']) ? $card['name'] : "Card" ?>
  </div>
</a>