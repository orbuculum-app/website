<!DOCTYPE html>
<html lang="en">
<?php
/* @var $headerContent array */
/* @var $siteContent array */

$features = include '../content/pages/features/features.php';

// $fieldLabels = $prices['plans.field_labels'];

$mobileLabelClass = 'mobile-label f-500 f-s-14 roboto';
$rowValueClass = 'row-value roboto f-700 f-s-14';
$rowDescClass = 'row-desc roboto f-400 txt-site-gray f-s-13';
$headerColumnRowsClass = 'roboto f-500 f-s-14';
$rowTitleClass = 'row-title fx-row fx-center'
?>

<head>
    <?php include '../partials/head.php' ?>
</head>


<body>
    <?php include '../partials/header/header.php' ?>
    <!-- PAGE CONTENT SECTION -->
    <main class="features__container fx-column">
        <div class="content fx-column gap-30">

            <!-- PAGE HERO SECTION -->
            <div class="features__hero fx-column gap-40 text-align-center fx-center">
                <div class="features__hero-header fx-column">
                    <?php if (!empty($features['page.title'])) : ?>
                        <h1 class="h1 txt-black f-700 f-s-36"><?= $features['page.title']; ?></h1>
                    <?php endif; ?>

                    <?php if (!empty($features['page.subtitle'])) : ?>
                        <p class="lead-text f-600"><?= $features['page.subtitle']; ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($features['page.text'])) : ?>
                    <p class="f-500 p txt-gray features__hero-text"><?= $features['page.text']; ?></p>
                <?php endif; ?>
            </div>

            <?php if (!empty($features['content.items']) && is_array($features['content.items'])) : ?>
                <?php foreach ($features['content.items'] as $item) : ?>
                    <div class="fx-column box gap-30 features__item<?php if (!empty($item['class'])) echo " {$item['class']}"; ?>">

                        <?php if (!empty($item['img_filename'])) : ?>
                            <div class="relative features__item-img">
                                <div class="bg-image" data-bg-fallback="<?= '/images/features/' . $item['img_filename'] . '.png'; ?>" data-bg-webp="<?= '/images/features/' . $item['img_filename'] . '.webp'; ?>">
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="fx-column gap-10 features__item-content">
                            <div class="fx-column gap-20">
                                <?php if (!empty($item['title'])) : ?>
                                    <h3 class="h2 f-700 txt-black title"><?= $item['title']; ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($item['text'])) : ?>
                                    <p class="txt-gray f-500 p text"><?= $item['text']; ?></p>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($item['link_text']) && !empty($item['link_url'])) : ?>
                                <a href="<?= $item['link_url']; ?>" class="f-700 f-s-14 text-blue link"><?= $item['link_text']; ?></a>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="features__cta box fx-column fx-center text-align-center gap-30">
                <div class="fx-column fx-center gap-10">
                    <?php if (!empty($features['cta.title'])) : ?>
                        <div class="h2 txt-black f-700"><?= $features['cta.title']; ?></div>
                    <?php endif; ?>

                    <?php if (!empty($features['cta.subtitle'])) : ?>
                        <div class="f-500 lead-text"><?= $features['cta.subtitle']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="fx-row fx-center gap-30 fx-wrap buttons-wrapper">
                    <?php if (!empty($features['cta.button_explore'])) : ?>
                        <a href="<?= $features['cta.button_explore']['link']; ?>" class="button button-bordered"><?= $features['cta.button_explore']['text']; ?></a>
                    <?php endif; ?>

                    <?php if (!empty($features['cta.button_start'])) : ?>
                        <a href="<?= $features['cta.button_start']['link']; ?>" class="button button-blue"><?= $features['cta.button_start']['text']; ?></a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>

    <footer>
        <?php include '../partials/footer/footer.php' ?>
    </footer>

    <?php include '../partials/scripts.php' ?>

</body>

</html>