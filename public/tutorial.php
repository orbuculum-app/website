<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/head.php' ?>
    <script type="module" src="js/faq.js?v=<?php echo $staticVersion; ?>" defer></script>
    <script type="module" src="js/learn-and-support/script.js?v=<?php echo $staticVersion; ?>" defer></script>
</head>

<body>
    <?php include '../partials/header/header.php' ?>

    <main class="features__container">
        <div class="content">
            <?php
            $file_path = __DIR__ . '/../content/pages/learn-and-support/shared/article_page.php';
            include($file_path);
            ?>
        </div>
    </main>

    <footer>
        <?php include '../partials/footer/footer.php' ?>
    </footer>

    <?php include '../partials/scripts.php' ?>
</body>

</html>