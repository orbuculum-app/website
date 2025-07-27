<?php
/** @var string[] $imgs */
/** @var bool $indexes_enabled */

$indexes_enabled = $indexes_enabled ?? false;
?>

<div class="gallery">
    <?php foreach ($imgs as $i => $img): ?>
        <div class="gallery__item">
            <img src="<?= htmlspecialchars($img) ?>" alt="Gallery image <?= $i + 1 ?>">
            <?php if ($indexes_enabled): ?>
                <div class="gallery__index"><?= $i + 1 ?></div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>