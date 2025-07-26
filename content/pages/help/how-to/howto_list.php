<?php
/** @var array $howto_list */
?>

<div class="howto-items">
    <?php foreach ($howto_list as $howto): ?>
        <?php
        $text = $howto['text'];
        $howto_item_steps = $howto['steps'];
        $href = $howto['href'];
        include __DIR__ . '/howto.php';
        ?>
    <?php endforeach; ?>
</div>
