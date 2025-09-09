<?php
$markdown = '';

if (isset($_GET['article']) && !empty($_GET['article'])) {
    $article_id = basename($_GET['article']);
    $file_path = __DIR__ . '/articles/' . $article_id . '.md';
    $markdown = file_get_contents($file_path);


    // if (file_exists($file_path)) {
    //     $markdown = file_get_contents($file_path);

    //     // Preprocess :::block-list ... ::: into <ul class="block-list">...</ul>
    //     $markdown = preg_replace_callback('/:::block-list\s*(.*?)\s*:::/s', function ($matches) {
    //         return "<ul class=\"block-list\">\n" . trim($matches[1]) . "\n</ul>";
    //     }, $markdown);

    //     $parser = new GithubMarkdown();
    //     $content = $parser->parse($markdown);

    // } else {
    //     $content = "<p>Article not found.</p>";
    // }
} else {
    include(__DIR__ . '/all.php');
    return; // Stop execution after including all.php
}
?>

<section class="spaced-content">
    <?php include __DIR__ . '/../shared/article/article_page.php'; ?>
</section>

<!-- FAQ section -->
<section class="faq-list big-card spaced-content">
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
    include __DIR__ . '/../how-to/list.php';
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
