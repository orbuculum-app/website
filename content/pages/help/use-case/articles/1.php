<?php
// ---------- CONFIGURATION DATA ----------
$steps = [
    ['title' => 'Introduction', 'is_intro' => true],
    ['title' => 'The Challenge'],
    ['title' => 'The Solution'],
    ['title' => 'The Way'],
];

$tutorialSteps = [
    [
        'title'      => 'The Challenge',
        'id'         => 'step-1',
        'content'    => 'GreenWorks Logistics operates in multiple cities...',
        'list'       => [
            'Reporting was manual and error-prone',
            'No control over who accessed which numbers',
            'Projects weren’t clearly separated',
        ],
        'list_class' => 'question-mark-list',
    ],
    [
        'title'      => 'The Solution',
        'id'         => 'step-2',
        'content'    => 'Orbuculum was implemented to centralize financial operations:',
        'list'       => [
            'Workflow setup: Separate workflows...',
            'User roles: Branch managers can view...',
            'Projects & categories: Expenses are tagged...',
            'Reporting: Automated monthly reports...',
        ],
        'list_class' => 'checkmark-list',
    ],
];

$companyInfo = [
    'Company'       => 'GreenWorks Logistics',
    'Industry'      => 'Transportation & Logistics',
    'Size'          => '40 employees',
    'Main challenge'=> 'Manual reporting and lack of structured access',
    'Solution'      => 'Workflow-based reporting + user access control',
    'Result'        => '3x faster reporting, clear project-level tracking, happier finance team',
];

$title      = "How GreenWorks Logistics Saves Time and Gains Financial Clarity with Orbuculum";
$breadcrumb = "Learn & Support / Use Case";

$workflowList = [
    'From the top menu, click on Workflows.',
    'On the Workflows page, click the Create new workflow button.'
];

// ---------- HELPERS ----------
function render_tutorial_step3($text, $index, $listItems, $imgs = [], $indexes_enabled = false, $prefixes = []) {
    echo "<div>";
    include __DIR__ . "/../../shared/article/article_step_title.php";

    echo "<ul class='small-list'>";
    foreach ($listItems as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
    echo "</div>";

    if ($imgs) {
        $GLOBALS['prefixes']        = $prefixes;
        $GLOBALS['indexes_enabled'] = $indexes_enabled;
        include __DIR__ . "/../../shared/photo_gallery.php";
    }
}

// ---------- PAGE CONTENT ----------
ob_start();
?>

<nav class="article-page__breadcrumb" id="step-0"><?= $breadcrumb ?></nav>
<h1 class="h1"><?= htmlspecialchars($title) ?></h1>

<ul class="use-case__author-info block-list">
    <?php foreach ($companyInfo as $label => $value): ?>
        <li><strong><?= $label ?>:</strong> <?= $value ?></li>
    <?php endforeach; ?>
</ul>

<p>
    Creating a workflow in Orbuculum helps you organize users, projects, categories, and accounts
    for your business. Workflows are the foundation of your financial management setup — let’s get started!
</p>

<section class="article-page__quote big-card spaced-content">
    <h2 class="h2">
        Before Orbuculum, I spent entire weekends pulling numbers from messy spreadsheets.
        Now I generate clean, investor-ready reports in minutes — and my team works more independently.
    </h2>
    <p>Try it yourself. Go to the Transactions tab now and add your first real entry.</p>
    <div class="article-page__quote-symbol">“</div>
</section>

<?php foreach ($tutorialSteps as $step): ?>
    <section class="spaced-content" id="<?= $step['id'] ?>">
        <div>
            <h2 class="h2"><?= htmlspecialchars($step['title']) ?></h2>
            <p><?= $step['content'] ?></p>
        </div>
        <ul class="<?= htmlspecialchars($step['list_class'] ?? 'small-list') ?>">
            <?php foreach ($step['list'] as $item): ?>
                <li><?= $item ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endforeach; ?>

<section class="spaced-content" id="step-<?= count($steps) - 1 ?>">
    <h2 class="h2">The Way</h2>

    <?php
    // Step 1
    render_tutorial_step3("Enter basic details", 1, $workflowList);

    echo '<iframe id="ytplayer" type="text/html" width="100%" height="490px"
            src="https://www.youtube.com/embed/M7lc1UVf-VE?color=white"
            frameborder="0" allowfullscreen></iframe>';

    // Step 2
    render_tutorial_step3("Go to Workflows", 2, $workflowList, [
        'https://placehold.co/600x400',
        'https://placehold.co/900x900'
    ]);

    // Step 3
    render_tutorial_step3("Enter basic details", 3, $workflowList, [
        'https://placehold.co/600x400'
    ]);

    // Step 4
    $step4Text = array_merge($workflowList, [
        "Accounting is the art of tracking financial transactions and ensuring that every penny is accounted for. 
         It involves recording, classifying, and summarizing financial data to provide insights into a business's performance. 
         Whether you're a small startup or a large corporation, effective accounting practices are crucial for making informed decisions 
         and achieving financial success. Let's dive into the world of numbers and discover how they tell the story of your business!"
    ]);

    render_tutorial_step3("Enter basic details", 4, $step4Text, [
        'https://placehold.co/600x400',
        'https://placehold.co/600x400',
        'https://placehold.co/600x400',
        'https://placehold.co/600x400'
    ], true, ['img-4a', 'img-4b', 'img-4c', 'img-4d']);

    include __DIR__ . "/../../shared/article/try_yourself.php";

    // Step 5
    render_tutorial_step3("Enter basic details", 5, $workflowList, [
        'https://placehold.co/600x400',
        'https://placehold.co/600x400',
        'https://placehold.co/600x400'
    ], true, ['img-5a', 'img-5b', 'img-5c']);
    ?>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../shared/article/article_page.php';
