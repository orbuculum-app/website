<?php




//TODO: When routing is made in ngix remove this whole file





if (!defined('ROOT_PATH')) {
    $root = __DIR__ . '/../';
    define('ROOT_PATH', $root);
}

require_once ROOT_PATH . 'partials/feature/feature-template.php';
require_once ROOT_PATH . '/vendor/autoload.php';

$allowed_pages = ['tutorials', 'how-to', 'use-case', 'faq'];
$page_name = (isset($_GET['page']) && in_array(basename($_GET['page']), $allowed_pages)) ? basename($_GET['page']) : '';
$current_page = $page_name;
$site_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
$isArticlePage = !empty($_GET['article']);



$isMainPage = empty($_GET['page']);

function load_page_content($path)
{
    if (file_exists($path)) {
        ob_start();
        require $path;
        return ob_get_clean();
    }
    return null;
}

$page_content = $isMainPage
        ? load_page_content(ROOT_PATH . 'pages/learn-and-support/main/index.php')
        : load_page_content(ROOT_PATH . "pages/learn-and-support/{$page_name}/index.php");

$breadcrumbs = [
        ['name' => 'Home', 'url' => $site_url, 'position' => 1],
        ['name' => 'Learn & Support', 'url' => $site_url . 'learn-and-support.php', 'position' => 2],
        ['name' => ucwords($page_name), 'url' => $site_url . 'learn-and-support.php?page=' . $page_name, 'position' => 3]
];

$current_url = $site_url . basename($_SERVER['PHP_SELF']);
if (!empty($_GET)) {
    $current_url .= '?' . http_build_query($_GET);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex, nofollow">
    <?php include ROOT_PATH . 'partials/head.php' ?>
    <?php foreach (['faq.js', 'learn-and-support/script.js', 'learn-and-support.js'] as $js): ?>
        <script type="module" src="js/<?= $js ?>?v=<?= $staticVersion ?>" defer></script>
    <?php endforeach; ?>
</head>

<body class="feature__page">
<?php include ROOT_PATH . 'partials/header/header.php' ?>
<main class="features__container feature__container fx-column">
    <div class="content">
        <?php if (!$isMainPage): ?>
            <?php include ROOT_PATH . 'partials/navigation.php'; ?>
        <?php endif; ?>

        <?php if ($isArticlePage): ?>
            <?php
                $markdown = file_get_contents(ROOT_PATH . "content/1.md");
            ?>
            <?php include ROOT_PATH . 'partials/article/article.php'; ?>

        <?php elseif ($page_name): ?>
            <?php foreach ($allowed_pages as $p): ?>
                <?php
                $content = load_page_content(ROOT_PATH . "pages/learn-and-support/$p/index.php");
                if ($content):
                    echo "<article id='" . htmlspecialchars($p) . "' class='feature-article fx-column gap-40'>$content</article>";
                endif;
                ?>
            <?php endforeach; ?>
            <div class="js-feature-container fx-column gap-40">

                <?php else: ?>
                <?= $page_content ?>
                <?php endif; ?>


        </div>
    </div>
</main>

<footer><?php include ROOT_PATH . 'partials/footer/footer.php' ?></footer>
<?php include ROOT_PATH . 'partials/scripts.php' ?>
<script>
    window.allowedPages = <?= json_encode($allowed_pages) ?>;
    window.currentPage = 'learn-and-support';
    window.currentSubPage = '<?= $current_page ?>';
</script>
<script src="js/feature-page.js?v=<?= $staticVersion ?>" defer></script>
</body>

</html>