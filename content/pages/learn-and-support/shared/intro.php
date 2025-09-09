<?php
/** @var string $title */
/** @var string $description */
/** @var array $links (each item: ['label' => ..., 'url' => ...]) */
?>

<section class="big-card help-intro">
    <div class="help-intro__item">
        <h1 class="help-intro__title"><?= htmlspecialchars($title) ?></h1>
        <p class="help-intro__description"><?= htmlspecialchars($description) ?></p>

        <div class="help-intro__links">
            <p class="help-intro__links-label">How can we help?</p>
            <div class="help-intro__links-list">
                <?php foreach ($links as $link): ?>
                    <a class="help-intro__links-link" href="<?= htmlspecialchars($link['url']) ?>">
                        <?= htmlspecialchars($link['label']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>