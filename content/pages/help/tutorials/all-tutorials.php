<?php
require_once __DIR__ . '/tutorial_tag.php';

$tutorials = [
    [
        'title' => 'Getting started with Orbuculum: your first 30 minutes',
        'description' => 'Set up your account, create your first workflow, and explore key features of the platform.',
        'duration' => '8 minutes',
        'image' => 'https://placehold.co/600x400',
        'tag' => TutorialTag::GettingStarted,
    ],
    [
        'title' => 'Building your first workflow from scratch',
        'description' => 'Start fresh by creating a custom workflow tailored to your business. Add projects, define categories',
        'duration' => '3 minutes',
        'image' => 'https://placehold.co/600x400',
        'tag' => TutorialTag::GettingStarted,
    ],
    [
        'title' => 'Managing user roles and permissions effectively',
        'description' => 'Control who can view, edit, or manage financial data in Orbuculum. Assign the right roles to team members',
        'duration' => '5 minutes',
        'image' => 'https://placehold.co/600x400',
        'tag' => TutorialTag::Workflows,
    ],
    [
        'title' => 'Managing user roles and permissions effectively',
        'description' => 'Control who can view, edit, or manage financial data in Orbuculum. Assign the right roles to team members',
        'duration' => '10 minutes',
        'image' => 'https://placehold.co/600x400',
        'tag' => TutorialTag::Users,
    ],
    [
        'title' => 'Managing user roles and permissions effectively',
        'description' => 'Control who can view, edit, or manage financial data in Orbuculum. Assign the right roles to team members',
        'duration' => '5 minutes',
        'image' => 'https://placehold.co/600x400',
        'tag' => TutorialTag::Workflows,
    ],
    [
        'title' => 'Managing user roles and permissions effectively',
        'description' => 'Control who can view, edit, or manage financial data in Orbuculum. Assign the right roles to team members',
        'duration' => '5 minutes',
        'image' => 'https://placehold.co/600x400',
        'tag' => TutorialTag::Users,
    ],
    [
        'title' => 'Managing user roles and permissions effectively',
        'description' => 'Control who can view, edit, or manage financial data in Orbuculum. Assign the right roles to team members',
        'duration' => '50 minutes',
        'image' => 'https://placehold.co/600x400',
        'tag' => TutorialTag::Workflows,
    ],
];

// Intro data
$help_intro = [
    'title' => 'Tutorials',
    'description' => 'Explore hands-on tutorials that guide you through real use cases in Orbuculum — from day-to-day tasks like tracking transactions  to advanced workflows, team collaboration, and financial analysis.',
    'links' => [
        ['label' => 'Find an answer', 'url' => ''],
        ['label' => 'Get started fast', 'url' => ''],
        ['label' => 'See real examples', 'url' => ''],
    ]
];

$title = $help_intro['title'];
$description = $help_intro['description'];
$links = $help_intro['links'];

include __DIR__ . '/../shared/_help_intro.php';
?>

<section class="spaced-content">
    <div>
        <h2 class="h2">Featured Tutorials</h2>
        <p class="section-description">
            Find quick answers to common questions about using Orbuculum. From account setup to report export — here are
            the things users ask most often.
        </p>
    </div>

    <?php
    include "navigation.php"
        ?>
    <div class="tutorial-article-list">
        <?php foreach ($tutorials as $tutorial): ?>
            <?php
            $title = $tutorial['title'];
            $description = $tutorial['description'];
            $duration = $tutorial['duration'];
            $image = $tutorial['image'];
            $tag = $tutorial['tag'];
            include __DIR__ . '/tutorial_article.php';
            ?>
        <?php endforeach; ?>
    </div>
</section>
