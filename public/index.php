<!DOCTYPE html>
<html lang="en">
<?php
/* @var $headerContent array */
/* @var $siteContent array */
$home = require dirname(__DIR__) . '/content/pages/home/index.php';
?>
<head>
<?php include '../partials/head.php' ?>
</head>

<body>
<?php include '../partials/header/header.php' ?>
<main class="main_container">
    <div class="main_container_content_wrap content fx-column">

        <section class="main__section fx-column gap-25" id="main-1">
            <div class="main__section--content fx-column gap-20">
                <div class="main__section--title fx-row txt-dark-grey f-s-25 f-500 gap-15">
                    <?= $siteContent['site.logo_dark_big'] ?>
                    <span><?= $siteContent['site.title'] ?></span>
                </div>
                <p class="main__section--desc txt-gray f-500 f-s-11"><?= $home['main-1.subtitle'] ?></p>
            </div>

            <button class="txt-asphalt-gray btn cursor-pointer fx-row fx-center">Try now</button>
        </section>

        <section class="main__section fx-column gap-25" id="main-2">
            <div class="main__section--content fx-column gap-10">
                <p class="main__section--title txt-black f-s-15 f-700">Constructor</p>
                <p class="main__section--desc txt-gray f-s-1 f-500">Contains accounts and transactions between them,
                    which can be assembled like ‘building blocks’.</p>
            </div>

            <a href="#" class="txt-zima-blue f-600 f-s-09 cursor-pointer">Read more →</a>
        </section>

        <section class="main__superpowers fx-column gap-40" id="superpowers">
            <div class="main__superpowers--title">
                <h2 class="f-600 f-s-2 txt-alt-gray"><?= $home['superpowers.title'] ?></h2>
            </div>
            <div class="main__superpowers--content fx-row">
                <?php foreach ($home['superpowers.items'] as $item): ?>
                    <div class="main__superpowers-item fx-column gap-15">
                        <?= $item['icon'] ?>
                        <div class="main__superpowers-item_text gap-10 fx-column fx-center">
                            <h3 class="f-800 f-s-11 txt-alt-gray"><?= $item['title'] ?></h3>
                            <p class="f-600 f-s-1 txt-gray"><?= $item['text'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="main__section fx-column gap-25" id="main-3">
            <div class="main__section--content fx-column gap-10">
                <p class="main__section--title txt-black f-s-15 f-700">Shows where the money is</p>
                <p class="main__section--desc txt-gray f-s-1 f-500">Transaction history, P&L, Cash Flow,
                    Balances.</p>
            </div>

            <a href="#" class="txt-zima-blue f-600 f-s-09 cursor-pointer">Read more →</a>
        </section>

        <section class="main__section fx-column gap-25" id="main-4">
            <div class="main__section--content fx-column gap-10">
                <p class="main__section--title txt-black f-s-15 f-700">SQL interface to client data</p>
                <p class="main__section--desc txt-gray f-s-1 f-500">Which enables the creation of custom
                    reports/dashboards
                    using external tools.</p>
            </div>

            <a href="#" class="txt-zima-blue f-600 f-s-09 cursor-pointer">Read more →</a>
        </section>

    </div>
    <div class="main__who-wrap fx-row">
        <section class="main__who content txt-white fx-column gap-40">
            <div class="main__who-title fx-column gap-10">
                <h3 class="f-s-2 f-700"><?= $home['who.title'] ?></h3>
                <p class="f-s-125 f-400"><?= $home['who.subtitle'] ?></p>
            </div>
            <div class="main__who-content fx-grid">
                <?php foreach ($home['who.items'] as $item) : ?>
                    <div class="main__who-content_item fx-column gap-25">
                        <div class="main__who-content_item-img bg-image"
                             style="background-image: url(<?= $item['img_path'] ?>)"></div>
                        <div class="main__who-content_item-text gap-10 fx-column">
                            <h4 class="f-700 f-s-1"><?= $item['title'] ?></h4>
                            <p class="f-400 f-s-09"><?= $item['text'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="main__who-register_btn fx-row fx-center">
                <button id="_main__register_btn" class="txt-white f-s-09 f-600 cursor-pointer fx-row fx-center">Register</button>
            </div>
        </section>
    </div>

    <div class="main_container_content_second_wrap  content fx-column">

        <section class="main__section fx-column gap-25" id="main-5">
            <div class="main__section--content fx-column gap-10">
                <p class="main__section--title txt-black f-s-15 f-700">Multi-currency support</p>
                <p class="main__section--desc txt-gray f-s-1 f-500">even custom 😉</p>
            </div>

            <a href="#" class="txt-zima-blue f-600 f-s-09 cursor-pointer">Read more →</a>
        </section>

        <section class="main__section fx-column gap-25" id="main-6">
            <div class="main__section--content fx-column gap-10">
                <p class="main__section--title txt-black f-s-15 f-700">Flexible access control system</p>
            </div>

            <a href="#" class="txt-zima-blue f-600 f-s-09 cursor-pointer">Read more →</a>
        </section>

    </div>
</main>

<footer>
    <?php include '../partials/footer/footer.php' ?>
</footer>

<?php include '../partials/scripts.php' ?>
</body>
</html>
