<?php
$help_intro = [
    'title' => 'Learn & Support',
    'description' => 'Welcome to the Orbuculum Help Center — your go-to place for step-by-step guides, FAQs, and practical tips. Whether you\'re setting up your first workflow, importing data, or managing users, you\'ll find everything you need to get started and grow with confidence.',
    'links' => [
        ['label' => 'Find an answer', 'url' => '#answer'],
        ['label' => 'Read a tutorial', 'url' => '#tutorial'],
        ['label' => 'Get started fast', 'url' => '#start'],
        ['label' => 'See real examples', 'url' => '#examples'],
        ['label' => 'Ask Question', 'url' => '#ask'],
    ]
];

$title = $help_intro['title'];
$description = $help_intro['description'];
$links = $help_intro['links'];
include '../content/pages/help/shared/_help_intro.php';

include '_help_main_tutorials.php';
include '_help_main_howtos.php';
include '_help_main_faq.php';


$title = "“Now I spend 3x less time preparing financial reports”";
$text = "Before Orbuculum, I used to spend entire weekends trying to align data from different spreadsheets and prepare reports for our partners. Now everything is automated — I can generate accurate financial reports in minutes. This gives me more time to focus on growing the business, not just managing it.";
$img = "https://placehold.co/700x1500";
$author = "by Alex Popescu, Founder of GreenWorks Logistics";
include '../content/pages/help/use-case/quote.php';


$links = [];
include '../content/pages/help/shared/_help_footer.php';
?>