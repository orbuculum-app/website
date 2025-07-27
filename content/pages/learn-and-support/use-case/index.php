<?php
if (isset($_GET['article']) && !empty($_GET['article'])) {
    $article_id = basename($_GET['article']);
    $file_path = __DIR__ . '/articles/' . $article_id . '.php';

    if (file_exists($file_path)) {
        ob_start();
        require $file_path;
        $page_content = ob_get_clean();
        echo $page_content;
    } else {
        echo "Article not found.";
    }
} else {
    $file_path = __DIR__ . '/all-cases.php';
    include($file_path);
}

$links = [
        ['label' => 'Visit FAQ', 'url' => ''],
        ['label' => 'See Real Use Cases', 'url' => ''],
        ['label' => 'Watch How To`s', 'url' => ''],
];
include '../content/pages/learn-and-support/shared/footer.php';
?>