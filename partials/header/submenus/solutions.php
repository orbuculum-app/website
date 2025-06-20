<?php
$solutions = require dirname(__DIR__, 3) . '/content/partials/submenus/solutions/solutions.php';
?>
<div class="submenu-cases submenu fx-row" id="menu_cases">
    <div class="submenu-cases__container submenu__content fx-column">
        <div class="submenu__header">
            <h2><?= $solutions['title'] ?></h2>
            <p><?= $solutions['subtitle'] ?></p>
        </div>
        <div class="submenu-cases__grid">
            <?php foreach ($solutions['menu.items'] as $item): ?>
                <div class="submenu-cases__item fx-row">
                    <?= $item['icon'] ?>
                    <div class="submenu-cases__item-text fx-column">
                        <h3><?= $item['title'] ?></h3>
                        <p><?= $item['text'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
