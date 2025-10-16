<?php
include ROOT_PATH . 'content/pages/learn-and-support/use-case.php';
include ROOT_PATH . 'pages/learn-and-support/shared/intro.php';
?>

<section class="use-cases spaced-content">
    <?php
    foreach ($quotes as $quote) {
        $text = $quote['text'];
        $title = $quote['title'];
        $author = $quote['author'];
        $img = $quote['img'];
        include ROOT_PATH . 'pages/learn-and-support/use-case/quote.php';
    }
    ?>
</section>

<section class="spaced-content">
    <h2 class="h2">Related How To</h2>
    <?php include ROOT_PATH . 'pages/learn-and-support/how-to/list.php'; ?>
</section>

<?php
include ROOT_PATH . 'pages/learn-and-support/shared/footer.php';
?>
