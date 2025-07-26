<?php
require_once __DIR__ . '/tutorial_tag.php';
?>

<nav class="tutorials-nav card">
    <ul class="tutorials-nav__list fx gap-20 wrap">
        <li class="tutorials-nav__item">
            <button class="tutorials-nav__button tag-button" data-tag="all" type="button">[ All tutorials ]</button>
        </li>
        <?php foreach (TutorialTag::cases() as $tag): ?>
            <li class="tutorials-nav__item">
                <button
                    class="tutorials-nav__button tag-button"
                    data-tag="<?= htmlspecialchars($tag->value) ?>"
                    type="button"
                >
                    [ <?= htmlspecialchars($tag->label()) ?> ]
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
