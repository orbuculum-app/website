<?php
$markdown = '';

$router = new AltoRouter();
$router->setBasePath('/learn-and-support/tutorials');

$router->map('GET', '', function() {
    include(ROOT_PATH . "pages/learn-and-support/tutorials/all.php");
});


$router->map('GET', '/[*:page]', function($page) use (&$markdown) {
    $path = ROOT_PATH . "pages/learn-and-support/tutorials/articles/{$page}.md";
    if (file_exists($path)) {
        $markdown = file_get_contents($path);
        include(ROOT_PATH . 'partials/article/article.php');
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo "Article not found";
    }
});


// Match and dispatch
$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "Page not found";
}
?>

<!--<section class="spaced-content">-->
<!--    --><?php //include ROOT_PATH . 'partials/article/article.php'; ?>
<!--</section>-->

<!-- FAQ section -->
<section class="faq-list big-card spaced-content" id="tutorials">
    <h2 class="h2">Related FAQ</h2>
    <?php
    $faq_list = [
        ['title' => 'How do I change my account settings?', 'text' => 'Go to your account page, click "Settings", and update your details.'],
        ['title' => 'Can I give access to specific projects only??', 'text' => 'Yes, head to "Team Management" and use the "Invite Member" button.'],
        ['title' => 'What file formats can I import transactions from?', 'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".'],
        ['title' => 'How is user access managed in Orbuculum?', 'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".'],
        ['title' => 'Where can I find my invoices or billing information?', 'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".'],
    ];
    include __DIR__ . '/../../learn-and-support/faq/list.php';
    ?>
    <?php
        $href = '/faqs';
        $text = 'See all FAQs';
        include __DIR__ . '/../shared/more_link.php';
    ?>
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
    include ROOT_PATH . 'pages/learn-and-support/how-to/list.php';
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
