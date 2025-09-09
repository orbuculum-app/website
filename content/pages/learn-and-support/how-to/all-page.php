<?php
$howto_sections = [
    [
        'title' => 'Workflows',
        'howtos' => [
            ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to import transactions from Excel', 'steps' => 4, 'href' => ''],
        ],
    ],
    [
        'title' => 'Users & Permissions',
        'howtos' => [
            ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to import transactions from Excel', 'steps' => 4, 'href' => ''],
            ['text' => 'How to import transactions from Excel', 'steps' => 4, 'href' => ''],
            ['text' => 'How to import transactions from Excel', 'steps' => 4, 'href' => ''],
            ['text' => 'How to import transactions from Excel', 'steps' => 4, 'href' => ''],
        ],
    ],
    [
        'title' => 'Transactions',
        'howtos' => [
            ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
        ],
    ],
    [
        'title' => 'Reports',
        'howtos' => [
            ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
        ],
    ],
    [
        'title' => 'Projects & Categories',
        'howtos' => [
            ['text' => 'How to create a new workflow', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
            ['text' => 'How to invite a new user', 'steps' => 4, 'href' => ''],
        ],
    ],
];

// Intro content
$help_intro = [
    'title' => 'Practical Step-by-Step Guides',
    'description' => 'Learn how to use Orbuculum through practical, step-by-step instructions that walk you through key features, from setting up your workflow to importing data, managing users, generating reports, and more.',
    'links' => [
        ['label' => 'Find an answer', 'url' => '#answer'],
        ['label' => 'Read a tutorial', 'url' => '#tutorial'],
        ['label' => 'See real examples', 'url' => '#examples'],
    ]
];

$title = $help_intro['title'];
$description = $help_intro['description'];
$links = $help_intro['links'];

include '../content/pages/learn-and-support/shared/intro.php';
?>


<?php foreach ($howto_sections as $section): ?>
    <section class="help-main-todos spaced-content">
        <h2 class="h2"><?= htmlspecialchars($section['title']) ?></h2>
        <?php
            $howto_list = $section['howtos'];
            include __DIR__ . '../../../learn-and-support/how-to/list.php';
        ?>
    </section>
<?php endforeach; ?>
