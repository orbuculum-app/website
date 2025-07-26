<?php

$allowed_pages = ['faq', 'use-case', 'how-to', 'tutorials'];
$page_content = null;
$current_page = isset($_GET['page']) && in_array(basename($_GET['page']), $allowed_pages) ? basename($_GET['page']) : '';

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page_name = basename($_GET['page']);

    if (in_array($page_name, $allowed_pages)) {
        $file_path = __DIR__ . '/../content/pages/help/' . $page_name . '/index.php';

        if (file_exists($file_path)) {
            ob_start();
            require $file_path;
            $page_content = ob_get_clean();
        }
    }
} else {
    $file_path = __DIR__ . '/../content/pages/help/main/index.php';

    if (file_exists($file_path)) {
        ob_start();
        require $file_path;
        $page_content = ob_get_clean();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/head.php' ?>
    <script type="module" src="js/faq.js?v=<?php echo $staticVersion; ?>" defer></script>
    <script type="module" src="js/help/script.js?v=<?php echo $staticVersion; ?>" defer></script>
        <script type="module" src="js/help.js?v=<?php echo $staticVersion; ?>" defer></script>
</head>

<body>
    <?php include '../partials/header/header.php' ?>

    <main class="features__container fx-column">
        <div class="content fx-column gap-40">
            <?php
            if ($page_content) {
                echo $page_content;
            } else {
                echo "<p>Page not found.</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <?php include '../partials/footer/footer.php' ?>
    </footer>

    <?php include '../partials/scripts.php' ?>
</body>

</html>