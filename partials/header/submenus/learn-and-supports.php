<?php

$learnAndSupports = require dirname(__DIR__, 3) . '/content/partials/submenus/learn-and-supports/learn-and-supports.php';
?>

<div class="submenu-ls submenu fx-row" id="menu_learn_and_support">
    <div class="submenu-ls__containers submenu__content fx-column">
        <div class="submenu-ls__content fx-row">
            <div class="submenu-ls__content-description">
                <div class="submenu__header">
                    <h2><?= $learnAndSupports['title'] ?></h2>
                    <p><?= $learnAndSupports['subtitle'] ?></p>
                </div>
                <p><?= $learnAndSupports['description'] ?></p>
            </div>
            <div class="submenu-ls__grid">
                <?php foreach ($learnAndSupports['menu.items'] as $item): ?>
                    <div class="submenu-ls__item fx-column">
                        <?= $item['icon'] ?>
                        <div class="submenu-ls__item-text fx-column">
                            <h3><?= $item['title']?></h3>
                            <p><?= $item['text']?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
