<?php
if (!defined('ROOT_PATH')) {
    $root = __DIR__ . '/../../';
    define('ROOT_PATH', $root);
}

require_once ROOT_PATH . '/vendor/autoload.php';

// Define allowed subpages
$allowed_pages = ['faq', 'tutorials', 'use-case', 'how-to'];

// Helper to load page content
function load_page_content($file) {
    if (file_exists($file)) {
        ob_start();
        include $file;
        return ob_get_clean();
    }
    return null;
}

$site_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';


$breadcrumbs = [
        ['name' => 'Home', 'url' => $site_url, 'position' => 1],
        ['name' => 'Learn & Support', 'url' => $site_url . 'learn-and-support', 'position' => 2],
        ['name' => ucwords('tutorials'), 'url' => $site_url . 'learn-and-support/' . 'tutorials', 'position' => 3]
];
?>

<div class="content">
    <?php include ROOT_PATH . 'partials/navigation.php'; ?>

    <div class="js-feature-container fx-column gap-40">
        <?php foreach ($allowed_pages as $p): ?>
            <?php
            $content = load_page_content(ROOT_PATH . "pages/learn-and-support/$p/index.php");
            if ($content):
                echo "<section id='" . htmlspecialchars($p) . "' class='feature-article fx-column gap-40'>";
                echo $content;
                echo "</section>";
            endif;
            ?>
        <?php endforeach; ?>
    </div>
</div>
