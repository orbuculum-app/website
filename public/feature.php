<?php

require_once __DIR__ . '/../partials/feature/feature-template.php';

$allowed_pages = ['core-engine', 'reporting', 'automation', 'permissions', 'data-tools', 'api'];
$page_content = null;
$current_page = isset($_GET['page']) && in_array(basename($_GET['page']), $allowed_pages) ? basename($_GET['page']) : '';

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page_name = basename($_GET['page']);

    if (in_array($page_name, $allowed_pages)) {
        $file_path = __DIR__ . '/../content/pages/feature/' . $page_name . '.php';

        if (file_exists($file_path)) {
            $page_content = require $file_path;
        }
    }
}

if (isset($_GET['json']) && $_GET['json'] === 'true') {
    header('Content-Type: application/json');
    if ($page_content) {
        echo json_encode([
            'content' => $page_content,
            'html' => renderArticle($page_content, $page_name, $allowed_pages),
            'pageName' => $current_page
        ]);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => 'Page not found']);
    }
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/head.php' ?>
</head>


<body>
    <?php include '../partials/header/header.php' ?>
    <!-- PAGE CONTENT SECTION -->
    <main class="features__container feature__container fx-column">
        <div class="js-feature-container content fx-column gap-50">

            <?php if ($page_content) {
                echo '<article id="' . htmlspecialchars($current_page) . '" class="feature-article">';
                echo renderArticle($page_content, $current_page, $allowed_pages);
                echo '</article>';
            } else {
                echo "<p>Page not found.</p>";
            } ?>

        </div>
    </main>

    <footer>
        <?php include '../partials/footer/footer.php' ?>

        <script>
            window.allowedPages = <?php echo json_encode($allowed_pages); ?>;
            window.currentPage = '<?php echo $current_page; ?>';
        </script>
        <script src="js/feature-page.js?v=<?php echo $staticVersion; ?>" defer></script>
    </footer>

    <?php include '../partials/scripts.php' ?>

</body>

</html>