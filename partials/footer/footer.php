<?php
/* @var $platform array */
/* @var $learnAndSupports array */
/* @var $solutions array */
/* @var $customProducts array */

$footer = require dirname(__DIR__, 2) . '/content/partials/footer.php';
?>

<footer id="_footer">
    <section class="footer__content_wrap fx-row content">
        <div class="footer__content-sitemap fx-grid">
            <div class="footer__sitemap-item fx-column">
                <div class="footer__orbuculum-logo fx-row">
                    <?= $footer['icon.logo'] ?>
                    <span><?= $footer['title'] ?></span>
                </div>
                <p><?= $footer['author_text'] ?></p>
            </div>

            <div class="footer__sitemap-item fx-column">
                <span><?= $platform['title'] ?></span>
                <ul>
                    <?php foreach ($platform['menu.items'] as $item): ?>
                        <li class="footer__sitemap-list_item"><?= $item['title'] ?></li>
                    <?php endforeach; ?>
                </ul>
                <span class="subtitle">Other functions</span>
                <ul>
                    <?php foreach ($platform['menu.additional_items'] as $item): ?>
                        <li class="footer__sitemap-list_item"><?= $item ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php foreach ([$customProducts, $solutions, $learnAndSupports] as $menu): ?>
                <div class="footer__sitemap-item fx-column">
                    <span><?= $menu['title'] ?></span>
                    <ul>
                        <?php foreach ($menu['menu.items'] as $item): ?>
                            <li class="footer__sitemap-list_item"><?= $item['title'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

            <div class="footer__sitemap-item fx-column">
                <span>Plan & Pricing</span>
            </div>
            <div class="footer__sitemap-item">
                <p class="mobile_c"><?= $footer['author_text'] ?></p>
            </div>
        </div>
        <div class="footer__logo">
            <?= $footer['icon.background_logo'] ?>
        </div>
    </section>
</footer>