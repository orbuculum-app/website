<?php
/** @var array $faq_list */
?>

<div class="faq-items">
    <?php foreach ($faq_list as $faq): ?>
        <?php
        $title = $faq['title'];
        $text = $faq['text'];
        include __DIR__ . '/item.php';
        ?>
    <?php endforeach; ?>
</div>
