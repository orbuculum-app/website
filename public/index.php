<?php
if (!defined('ROOT_PATH')) {
    $root = __DIR__ . '/../';
    define('ROOT_PATH', $root);
}

require_once ROOT_PATH . '/vendor/autoload.php';

$router = new AltoRouter();
$article_id = -1;

// Tutorials can have articles (/learn-and-support/tutorials/slug)
$router->map('GET', '/learn-and-support/tutorials[*:rest]', function($rest) {
    $_SERVER['REQUEST_URI'] = '/learn-and-support/tutorials' . $rest;
    include(__DIR__ . '/../pages/learn-and-support/tutorials/index.php');
});

// Other sections (faq, use-case, how-to)
$router->map('GET', '/learn-and-support/faq', function() {
    $_SERVER['REQUEST_URI'] = '/learn-and-support/faq';
    include(__DIR__ . '/../pages/learn-and-support/faq/index.php');
});

$router->map('GET', '/learn-and-support/use-case', function() {
    $_SERVER['REQUEST_URI'] = '/learn-and-support/use-case';
    include(__DIR__ . '/../pages/learn-and-support/use-case/index.php');
});

$router->map('GET', '/learn-and-support/how-to', function() {
    $_SERVER['REQUEST_URI'] = '/learn-and-support/how-to';
    include(__DIR__ . '/../pages/learn-and-support/how-to/index.php');
});

// Root Learn & Support → handled by learn-and-support/index.php
$router->map('GET', '/learn-and-support', function() {
    include(__DIR__ . '/../pages/learn-and-support/index.php');
});

// Homepage
$router->map('GET', '/', function() {
    include(__DIR__ . '/../pages/index.php');
});

// 404
$router->map('GET', '/404', function() {
    include(ROOT_PATH . 'pages/404.php');
});

// Match the route BEFORE sending HTML
$match = $router->match();
if (!$match) {
    header("HTTP/1.0 404 Not Found");
    $content = file_get_contents(ROOT_PATH . 'pages/404.php');
} else {
    ob_start();
    call_user_func_array($match['target'], $match['params']);
    $content = ob_get_clean();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../partials/head.php'; ?>
</head>
<body>
<?php include '../partials/header/header.php'; ?>
<main class="main_container">
    <div class="content spaced-content">
        <?php echo $content; ?>
    </div>
</main>
<footer>
    <?php include '../partials/footer/footer.php'; ?>
</footer>
<?php include '../partials/scripts.php'; ?>
<script src="/js/feature-page.js?v=<?php echo $staticVersion; ?>" defer></script>
</body>
</html>
