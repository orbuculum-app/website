<?php
require_once ROOT_PATH . 'content/pages/learn-and-support/how-to.php';
include ROOT_PATH . 'pages/learn-and-support/shared/intro.php';
?>

<?php foreach ($howto_sections as $section): ?>
    <section class="help-main-todos spaced-content">
        <h2 class="h2"><?= htmlspecialchars($section['title']) ?></h2>
        <?php
        $howto_list = $section['howtos'];
        include ROOT_PATH . 'pages/learn-and-support/how-to/list.php';
        ?>
    </section>
<?php endforeach; ?>

<?php
include ROOT_PATH . 'pages/learn-and-support/shared/footer.php';
?>