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