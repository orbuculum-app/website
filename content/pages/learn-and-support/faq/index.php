<?php
$links = [
    ['label' => 'Find an answer', 'url' => '#answer'],
    ['label' => 'Get started fast', 'url' => '#tutorial'],
    ['label' => 'See real examples', 'url' => '#start'],
];
$title = 'All FAQ\'s';
$description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam a repudiandae perspiciatis sed iste ut nulla ipsum, veritatis facere tempore quos magnam deserunt error dignissimos magni veniam consectetur voluptate. Odio.';
include '../content/pages/learn-and-support/shared/intro.php';
?>

<section class="faq-list big-card spaced-content">
    <input placeholder="Search FAQ's" class="faq-list__search" type="search" />
    <p class="section-description">Find quick answers to common questions about using Orbuculum.From account setup
        to
        report export — here are the things users ask most often.</p>
    <?php
    $faq_list = [
        [
            'title' => 'How do I change my account settings?',
            'text' => 'Go to your account page, click "Settings", and update your details.',
        ],
        [
            'title' => 'Can I invite team members?',
            'text' => 'Yes, head to "Team Management" and use the "Invite Member" button.',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],

        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],



        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
    ];

    include __DIR__ . '../../../learn-and-support/faq/list.php';
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