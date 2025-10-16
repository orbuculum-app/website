<?php
$howto_list = [
    ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
    ['text' => 'Invite and assign team members', 'steps' => 3, 'href' => ''],
    ['text' => 'Export your reports', 'steps' => 2, 'href' => ''],
];
?>

<section class="help-main-todos spaced-content">
    <h2 class="h2">Quick how-to`s to get you going</h2>
    <?php
    include __DIR__ . '/../how-to/list.php';
    ?>

    <?php
    $href = '/todos';
    $text = 'Browse all how-to guides';
    include __DIR__ . '/../shared/more_link.php';
    ?>
</section>