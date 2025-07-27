<?php
// ---------- CONFIGURATION DATA ----------
$steps = [];
$title      = "Test how-to";

$workflowList = [
    'From the top menu, click on Workflows.',
    'On the Workflows page, click the Create new workflow button.'
];

// ---------- HELPERS ----------
function render_tutorial_step2($text, $index, $listItems, $imgs = [], $indexes_enabled = false, $prefixes = [])
{
    echo "<div>";
    include __DIR__ . "/../../shared/article/article_step_title.php";

    echo "<ul class='small-list'>";
    foreach ($listItems as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
    echo "</div>";

    if ($imgs) {
        $GLOBALS['prefixes']        = $prefixes;
        $GLOBALS['indexes_enabled'] = $indexes_enabled;
        include __DIR__ . "/../../shared/photo_gallery.php";
    }
}

// ---------- PAGE CONTENT ----------
ob_start();
?>

<h1 class="h1" id="step-0"><?= htmlspecialchars($title) ?></h1>

<p>
   No sidebar here.
</p>

<ul class="use-case__author-info block-list">
    <p>What you read in this tutorial</p>
    <ul class="small-list">
        <li>You need to have an active Orbuculum account.</li>
        <li>You must have permission to create workflows.</li>
    </ul>
</ul>

<section class="spaced-content" id="step-1">
    <?php render_tutorial_step2("Enter basic details", 1, $workflowList); ?>

    <iframe id="ytplayer" type="text/html" width="100%" height="490px"
            src="https://www.youtube.com/embed/M7lc1UVf-VE?color=white"
            frameborder="0" allowfullscreen></iframe>
</section>

<section class="spaced-content" id="step-2">
    <?php
    render_tutorial_step2("Go to Workflows", 2, $workflowList, [
        'https://placehold.co/600x400',
        'https://placehold.co/900x900'
    ]);
    ?>
</section>

<section class="spaced-content" id="step-3">
    <?php
    render_tutorial_step2("Add first details", 3, $workflowList, [
        'https://placehold.co/600x400'
    ]);
    ?>
</section>

<section class="spaced-content" id="step-4">
    <?php
    $step4Text = array_merge($workflowList, [
        "Accounting is the art of tracking financial transactions and ensuring that every penny is accounted for. 
         It involves recording, classifying, and summarizing financial data to provide insights into a business's performance. 
         Whether you're a small startup or a large corporation, effective accounting practices are crucial for making informed decisions 
         and achieving financial success. Let's dive into the world of numbers and discover how they tell the story of your business!"
    ]);

    render_tutorial_step2("Learn about accounting", 4, $step4Text, [
        'https://placehold.co/600x400',
        'https://placehold.co/600x400',
        'https://placehold.co/600x400',
        'https://placehold.co/600x400'
    ], true, ['img-4a', 'img-4b', 'img-4c', 'img-4d']);
    ?>
</section>

<?php include __DIR__ . "/../../shared/article/try_yourself.php"; ?>

<section class="spaced-content" id="step-5">
    <?php
    render_tutorial_step2("Try it yourself", 5, $workflowList, [
        'https://placehold.co/600x400',
        'https://placehold.co/600x400',
        'https://placehold.co/600x400'
    ], true, ['img-5a', 'img-5b', 'img-5c']);
    ?>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../shared/article/article_page.php';
?>

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
    include __DIR__ . '/../../how-to/howto_list.php';
    ?>
</section>