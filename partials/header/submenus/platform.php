<?php
$platform = require dirname(__DIR__, 3) . '/content/partials/submenus/platform/platform.php';
?>

<div class="submenu-platform submenu fx-row" id="menu_platform">
    <div class="submenu-platform__container submenu__content fx-column fx-center">
        <div class="submenu__header">
            <h2><?= $platform['title'] ?></h2>
            <p><?= $platform['subtitle'] ?></p>
        </div>
        <nav class="submenu-platform__content fx-row fx-center">
            <div class="submenu-platform__grid">
                <?php foreach ($platform['menu.items'] as $item): ?>
                    <div class="submenu-platform__grid-item fx-row">
                        <?= $item['icon'] ?>
                        <div class="submenu-platform__text fx-column">
                            <h3><?= $item['title'] ?></h3>
                            <p><?= $item['text'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="submenu-platform__additional fx-column fx-center">
                <span class="submenu-platform__additional-title">Other Functions</span>
                <ul class="submenu-platform__list fx-column">
                    <?php foreach ($platform['menu.additional_items'] as $title) : ?>
                        <li class="submenu-platform__list-item"><?= $title ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
    </div>
</div>