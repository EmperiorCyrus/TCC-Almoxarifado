<!-- menu-card.php -->
<a href="<?= isset($card['url']) ? $card['url'] : '/' ?>">
  <div class="card card-custom-sga bg-blue w-100 p-4 shadow-sm">
    <?= isset($card['name']) ? $card['name'] : "Card" ?>
  </div>
</a>