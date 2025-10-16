<?php
require_once ROOT_PATH . "content/pages/learn-and-support/faq.php";
include ROOT_PATH . 'pages/learn-and-support/shared/intro.php';
?>

<section class="faq-list big-card spaced-content" id="faq">
    <input placeholder="Search FAQ's" class="faq-list__search" type="search" />
    <p class="section-description">Find quick answers to common questions about using Orbuculum.From account setup
        to
        report export — here are the things users ask most often.</p>
    <?php


    include __DIR__ . '../../../learn-and-support/faq/list.php';
    ?>
</section>

<?php
$links = [
    ['label' => 'Visit FAQ', 'url' => ''],
    ['label' => 'See Real Use Cases', 'url' => ''],
    ['label' => 'Watch How To`s', 'url' => ''],
];
include __DIR__ . '/../shared/footer.php';
?>