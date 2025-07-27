<?php
/** @var string $title */
/** @var string $text */
/** @var string $author */
/** @var string $img */
?>

<div class="big-card quote">
    <div class="quote__item quote__content spaced-content">
        <div class="quote__tag">Use Case</div>
        <h3 class="h2"><?= htmlspecialchars($title) ?></h3>
        <div class="italic">by <?= htmlspecialchars($author) ?></div>
        <p class="quote__text"><?= htmlspecialchars($text ?? '') ?></p>
        <?php
        $href = "/";
        $text = "Read more";
        include __DIR__ . '/../shared/more_link.php'; ?>
    </div>
    <div class="quote__item quote__img">
        <img src="<?= htmlspecialchars($img) ?>" />
    </div>
</div>
