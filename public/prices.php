<!DOCTYPE html>
<html lang="en">
<?php
/* @var $headerContent array */
/* @var $siteContent array */

$prices = include '../content/pages/prices/prices.php';
$fieldLabels = $prices['plans.field_labels'];

$mobileLabelClass = 'mobile-label f-500 f-s-14 roboto';
$rowValueClass = 'row-value roboto f-700 f-s-14';
$rowDescClass = 'row-desc roboto f-400 txt-site-gray f-s-13';
$headerColumnRowsClass = 'roboto f-500 f-s-14';
$rowTitleClass = 'row-title fx-row fx-center'
?>
<head>
    <?php include '../partials/head.php' ?>
    <script type="module" src="js/prices.js?v=<?php echo $staticVersion; ?>" defer></script>
    <!-- Optimized script for handling only Growth plan height adjustments -->
    <script type="module" src="js/prices_resize.js?v=<?php echo $staticVersion; ?>" defer></script>
</head>


<body>
<?php include '../partials/header/header.php' ?>
<!-- PAGE CONTENT SECTION -->
<main class="prices__container fx-column">

    <div class="prices__content fx-column content gap-40">

        <!-- PAGE HEADER SECTION -->
        <span class="plans__include-title txt-black f-700 f-s-36 fx-row fx-center text-align-center"
              style="margin-top: 40px;" fetchpriority="high"><?= $prices['include.title'] ?></span>

        <!-- PRICING GRID SECTION -->
        <section class="plans__list fx-column gap-20">
            <div class="plans__choice-buttons fx-row fx-center  txt-alt-gray f-s-13">
                <button id="__monthly" class="plans__choice-monthly fx-row fx-center _selected">
                    <span class="_title f-600">Monthly</span>
                </button>
                <button id="__yearly" class="plans__choice-year fx-column fx-center">
                    <span class="_title f-700">Annual Payment</span>
                    <span class="_subtitle f-500 roboto" style="font-size: 11px;">Save <span
                                class="txt-green f-900 roboto">15%</span></span>
                </button>
            </div>

            <!-- PRICING GRID SECTION -->
            <div class="plans__list-grid fx-grid txt-alt-gray roboto">
                <!-- HEADER COLUMN -->
                <div class="plans__item fx-column  __header_column">
                    <div class="plans__item-row __row-1"></div>
                    <div class="plans__item-row fx-row __row-9 __dark_row">
                        <span class="<?= $headerColumnRowsClass ?>"><?= $fieldLabels['__row_9'] ?></span>
                    </div>
                    <div class="plans__item-row fx-row __row-2 ">
                        <span class="<?= $headerColumnRowsClass ?>"><?= $fieldLabels['__row_2'] ?></span>
                    </div>

                    <div class="plans__item-row fx-row __row-4 __dark_row">
                        <span class="<?= $headerColumnRowsClass ?>"><?= $fieldLabels['__row_4'] ?></span>
                    </div>

                    <div class="plans__item-row fx-row __row-5 ">
                        <span class="<?= $headerColumnRowsClass ?>"><?= $fieldLabels['__row_5'] ?></span>
                    </div>
                    <div class="plans__item-row fx-row __row-6 __dark_row">
                        <span class="<?= $headerColumnRowsClass ?>"><?= $fieldLabels['__row_6'] ?></span>
                    </div>
                    <div class="plans__item-row fx-row __row-7 ">
                        <span class="<?= $headerColumnRowsClass ?>"><?= $fieldLabels['__row_7'] ?></span>
                    </div>
                    <div class="plans__item-row fx-row __row-8 __dark_row">
                        <span class="<?= $headerColumnRowsClass ?>"><?= $fieldLabels['__row_8'] ?></span>
                    </div>

                </div>

                <!-- PLAN ITEMS LOOP -->
                <?php foreach ($prices['plans.items'] as $plan): ?>
                    <div class="plans__item fx-column <?= $plan['class'] ?>">
                        <div class="plans__item-content fx-column">

                            <!-- PLAN HEADER -->
                            <div class="plans__item-row __row-1 gap-20 text-align-center">
                                <div class="plans__item-title gap-5 fx-column">
                                    <span class="_title txt-gray f-700 f-s-24"><?= $plan['name'] ?></span>
                                    <span class="_desc txt-site-gray f-400 f-s-13 roboto"><?= $plan['desc'] ?></span>
                                </div>
                                <div class="plans__item-price <?= isset($plan['display_settings']['price_gap']['monthly']) ? $plan['display_settings']['price_gap']['monthly'] : 'gap-7' ?> fx-column"
                                     data-monthly-gap="<?= isset($plan['display_settings']['price_gap']['monthly']) ? $plan['display_settings']['price_gap']['monthly'] : 'gap-7' ?>"
                                     data-yearly-gap="<?= isset($plan['display_settings']['price_gap']['yearly']) ? $plan['display_settings']['price_gap']['yearly'] : 'gap-7' ?>">
                                    <?php if ($plan['class'] === '_ultimate'): ?>
                                        <span class="f-s-13 roboto f-500 txt-alt-gray">Free trial for 3 months!</span>
                                    <?php endif; ?>
                                    <span class="_price txt-gray f-700 __monthly f-s-24 letter-spacing--2px"><?= $plan['price']['monthly']['value'] ?></span>
                                    <span class="_price_info __monthly txt-gray f-900 f-s-12 roboto"><?= $plan['price']['monthly']['desc'] ?></span>

                                    <span class="_price txt-gray __yearly f-700 f-s-24 letter-spacing--2px"
                                          style="display: none"><?= $plan['price']['yearly']['value'] ?></span>
                                    <span class="_price_info __yearly txt-gray f-900 f-s-12 roboto"
                                          style="display: none"><?= $plan['price']['yearly']['desc'] ?></span>
                                </div>
                                <?php if ($plan['class'] === '_ultimate'): ?>
                                    <div class='f-s-12 f-500 fx-column gap-7 roboto'
                                         style="z-index: 2; position: relative;">
                                        <?= $plan['price']['extra_info'] ?>
                                        <span class="roboto">No credit card required</span>
                                    </div>
                                <?php endif; ?>
                                <button class="plans__item-btn roboto">Start</button>
                            </div>

                            <!-- PLAN DETAILS -->
                            <div class="plans__item-row __row-9 __dark_row fx-row gap-10">
                                <span class="<?= $mobileLabelClass ?> roboto"><?= $fieldLabels['__row_9'] ?></span>
                                <span class="row-value roboto f-400 f-s-13"><?= $plan['for_who'] ?></span>
                            </div>

                            <div class="plans__item-row __row-2 fx-column roboto ">
                                <div class="<?= $rowTitleClass ?>">
                                    <span class="<?= $mobileLabelClass ?>"><?= $fieldLabels['__row_2'] ?></span>
                                    <span class="<?= $rowValueClass ?>"><?= $plan['accounts']['value'] ?></span>
                                </div>
                                <span class="<?= $rowDescClass ?>"><?= $plan['accounts']['desc'] ?></span>
                            </div>

                            <div class="plans__item-row __row-4 fx-column fx-center gap-5 roboto __dark_row">
                                <div class="<?= $rowTitleClass ?>">
                                    <span class="<?= $mobileLabelClass ?> "><?= $fieldLabels['__row_4'] ?></span>
                                    <span class="<?= $rowValueClass ?>"><?= $plan['transactions']['value'] ?></span>
                                </div>
                                <span class="<?= $rowDescClass ?>"><?= $plan['transactions']['desc'] ?></span>
                            </div>



                            <div class="plans__item-row __row-5 fx-column roboto ">
                                <div class="<?= $rowTitleClass ?>">
                                    <span class="<?= $mobileLabelClass ?>"><?= $fieldLabels['__row_5'] ?></span>
                                    <span class="<?= $rowValueClass ?>"><?= $plan['cost_additional_transactions']['value'] ?></span>
                                </div>
                                <span class="<?= $rowDescClass ?>"><?= $plan['cost_additional_transactions']['desc'] ?></span>
                            </div>

                            <div class="plans__item-row __row-6 fx-column roboto __dark_row">
                                <div class="<?= $rowTitleClass ?>">
                                    <span class="<?= $mobileLabelClass ?>"><?= $fieldLabels['__row_6'] ?></span>
                                    <span class="<?= $rowValueClass ?> fx-row"><?php if ($plan['manager']['value']): ?>
                                            <svg class="fx-row" width="23" height="22" viewBox="0 0 23 22" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <ellipse cx="11.4246" cy="11.395" rx="10.625" ry="10.314"
                                                         fill="#4E5B76"/>
                                                <path d="M9.01623 16.3809L5.04956 12.4022L6.43789 11.0096L9.01623 13.5958L15.5612 7.03088L16.9496 8.42344L9.01623 16.3809Z"
                                                      fill="white"/>
                                            </svg><?php endif; ?></span>
                                </div>
                                <span class="<?= $rowDescClass ?>"><?= $plan['manager']['desc'] ?></span>
                            </div>

                            <div class="plans__item-row __row-7 fx-column roboto">
                                <div class="<?= $rowTitleClass ?>">
                                    <span class="<?= $mobileLabelClass ?>"><?= $fieldLabels['__row_7'] ?></span>
                                    <span class="<?= $rowValueClass ?>"><?= $plan['supported_integration']['value'] ?></span>
                                </div>
                                <span class="<?= $rowDescClass ?>"><?= $plan['supported_integration']['desc'] ?></span>
                            </div>

                            <div class="plans__item-row __row-8 fx-column roboto __dark_row">
                                <div class="<?= $rowTitleClass ?>">
                                    <span class="<?= $mobileLabelClass ?>"><?= $fieldLabels['__row_8'] ?></span>
                                    <span class="<?= $rowValueClass ?>"><?= $plan['integration_updating']['value'] ?></span>
                                </div>
                                <span class="<?= $rowDescClass ?>"><?= $plan['integration_updating']['desc'] ?></span>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <section class="plans__include fx-column gap-20">
                <div class="plans__include-header fx-column gap-15 fx-center">
                    <span class="plans__include-subtitle txt-alt-gray f-700 f-s-24 text-align-center"><?= $prices['include.subtitle'] ?></span>
                </div>
                <div class="plans__include-grid gap-10 fx-grid">
                    <?php foreach ($prices['include.items'] as $item): ?>
                        <div class="includes__item gap-15 fx-row">
                            <svg style="min-width: 25px; min-height: 25px" width="25" height="25" viewBox="0 0 26 25"
                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                <ellipse cx="12.9995" cy="12.2684" rx="12.5" ry="12.1342"
                                         fill="url(#paint0_linear_1220_2514)"/>
                                <path d="M10.1662 18.1342L5.49951 13.4534L7.13285 11.8151L10.1662 14.8576L17.8662 7.13422L19.4995 8.77251L10.1662 18.1342Z"
                                      fill="white"/>
                                <defs>
                                    <linearGradient id="paint0_linear_1220_2514" x1="0.499512" y1="2.30749" x2="26.4297"
                                                    y2="4.14894" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#00F0FF"/>
                                        <stop offset="1" stop-color="#1DA5F1"/>
                                    </linearGradient>
                                </defs>
                            </svg>

                            <div class="includes__item-text fx-column ">
                                <span class="_title txt-black f-700 f-s-08"><?= $item['title'] ?></span>
                                <span class="_subtitle txt-site-gray roboto f-400 txt-site-gray f-s-13"><?= $item['text'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </section>

        <section class="plans__extra_info fx-row">
            <div class="plans__extra_info-img bg-image"
                 data-bg-fallback="<?= $prices['extra_info.image_path'] ?>"
                 data-bg-webp="<?= str_replace('.png', '.webp', $prices['extra_info.image_path']) ?>"
                 data-priority="true">
            </div>
            <div class="plans__extra_info-content fx-column gap-15">
                <span class="_title txt-black f-s-32 f-700"><?= $prices['extra_info.title'] ?> </span>
                <span class="_text txt-alt-gray f-s-14 f-500 fx-column"><?= $prices['extra_info.text'] ?> </span>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="plans__faq">
            <div class="plans__faq-container">
                <h2 class="plans__faq-title f-700 f-s-32 txt-black"><?= $prices['faq.title'] ?></h2>
                <?php foreach ($prices['faq.items'] as $index => $faq): ?>
                    <div class="faq-item">
                        <div class="faq-header">
                            <div class="faq-question">
                                <h3 class="f-600 f-s-16 txt-black"><?= $faq['question'] ?></h3>
                                <span class="faq-toggle">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="faq-icon faq-plus">
                                        <path d="M8 3.33337V12.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.33301 8H12.6663" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="faq-icon faq-minus">
                                        <path d="M3.33301 8H12.6663" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="faq-content">
                            <div class="faq-answer txt-alt-gray f-s-14 f-500">
                                <?= $faq['answer'] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="plans__server fx-row">
<!--                 data-bg-fallback="--><?php //= $prices['server.image_path'] ?><!--"-->
<!--                 data-bg-webp="--><?php //= str_replace('.png', '.webp', $prices['server.image_path']) ?><!--"-->
<!--        >-->
            <div class="plans__server-img bg-image"  style="background-image: url('images/prices/server_img_3.png')"></div>
            <div class="plans__server-content  fx-column">
                <span class="_title f-700 f-s-32 txt-white"><?= $prices['server.title'] ?></span>
                <span class="_text f-500 f-s-14 txt-white"><?= $prices['server.text'] ?></span>
<!--                <button class="cursor-pointer"><span class="f-600 f-s-16 txt-white">Start free trial</span></button>-->
            </div>
        </section>

    </div>
</main>

<footer>
    <?php include '../partials/footer/footer.php' ?>
</footer>


<div id="_tooltip_container_wrap">
    <div id="_tooltip_container" class="fx-row fx-center txt-white text-align-center f-400 f-s-12">
    </div>
</div>

<?php include '../partials/scripts.php' ?>
<!-- prices.js is already loaded in the head -->

</body>
</html>
