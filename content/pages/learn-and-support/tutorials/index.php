<?php
if (isset($_GET['article']) && !empty($_GET['article'])) {
    $article_id = basename($_GET['article']);

    $file_path = __DIR__ . '/articles/' . $article_id . '.php';

    if (file_exists($file_path)) {
        ob_start();
        require $file_path;
        $page_content = ob_get_clean();
        echo $page_content;
    }
} else {
    $file_path = __DIR__ . '/all.php';
    include($file_path);
}
?>

<section class="faq-list big-card spaced-content">
    <h2 class="h2">Related FAQ</h2>
    <?php
    $faq_list = [
        [
            'title' => 'How do I change my account settings?',
            'text' => 'Go to your account page, click "Settings", and update your details.',
        ],
        [
            'title' => 'Can I give access to specific projects only??',
            'text' => 'Yes, head to "Team Management" and use the "Invite Member" button.',
        ],
        [
            'title' => 'What file formats can I import transactions from?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How is user access managed in Orbuculum?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'Where can I find my invoices or billing information?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
    ];

    include __DIR__ . '/../../learn-and-support/faq/list.php';
    ?>
    <?php
    $href = '/faqs';
    $text = 'See all FAQs';
    include __DIR__ . '/../shared/more_link.php';
    ?>
</section>
<?php
$howto_list = [
    ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
    ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
    ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
    ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
];
?>

<section class="spaced-content">
    <h2 class="h2">Related How To</h2>
    <?php
    include __DIR__ . '/../how-to/list.php';
    ?>
</section>
<?php

$links = [
        ['label' => 'Visit FAQ', 'url' => ''],
        ['label' => 'See Real Use Cases', 'url' => ''],
        ['label' => 'Watch How To`s', 'url' => ''],
];
include __DIR__ . '/../shared/footer.php';
?>