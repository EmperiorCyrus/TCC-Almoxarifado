<!-- menu-card.php -->
<a href="<?= isset($card['url']) ? $card['url'] : '/' ?>">
  <div class="card bg-blue w-100 p-4 shadow-sm">
    <?= isset($card['name']) ? $card['name'] : "Card" ?>
  </div>
</a>