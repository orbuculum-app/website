<?php
include(__DIR__ . '/all.php');
?>

<section class="spaced-content" id="how-to">
    <?php include __DIR__ . '/../shared/article/article.php'; ?>
</section>

<?php
$howto_list = [
    ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
    ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
    ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
    ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
];
?>

<section class="spaced-content">
    <h2 class="h2">Related How To</h2>
    <?php
    include __DIR__ . '/../../how-to/list.php';
    ?>
</section>

<?php
$links = [
        ['label' => 'Visit FAQ', 'url' => ''],
        ['label' => 'See Real Use Cases', 'url' => ''],
        ['label' => 'Watch How To`s', 'url' => ''],
];
include '../content/pages/learn-and-support/shared/footer.php';
?>