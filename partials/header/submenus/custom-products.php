<?php
$customProducts = require dirname(__DIR__, 3) . '/content/partials/submenus/custom-products/custom-products.php';
?>
<!--cp is Custom Products-->
<div class="submenu-cp submenu fx-row" id="menu_custom_products">
    <div class="submenu-cp__container submenu__content fx-column">
        <div class="submenu__header">
            <h2><?= $customProducts['title'] ?></h2>
            <p><?= $customProducts['subtitle'] ?></p>
        </div>
        <div class="submenu-cp__grid">
            <?php foreach ($customProducts['menu.items'] as $item) :?>
                <div class="submenu-cp__item fx-row">
                    <?= $item['icon'] ?>
                    <div class="submenu-cp__item-text fx-column">
                        <h3><?= $item['title'] ?></h3>
                        <p><?= $item['text'] ?></p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
