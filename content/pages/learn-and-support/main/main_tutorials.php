<section class="spaced-content">
    <?php
    $tutorials = [
        [
            'title' => 'Getting started with Orbuculum: your first 30 minutes',
            'description' => 'Set up your account, create your first workflow, and explore key features of the platform.',
            'duration' => '8 minutes',
            'image' => 'https://placehold.co/600x400',
        ],
        [
            'title' => 'Building your first workflow from scratch',
            'description' => 'Start fresh by creating a custom workflow tailored to your business. Add projects, define categories',
            'duration' => '3 minutes',
            'image' => 'https://placehold.co/600x400',
        ],
        [
            'title' => 'Managing user roles and permissions effectively',
            'description' => 'Control who can view, edit, or manage financial data in Orbuculum. Assign the right roles to team members',
            'duration' => '5 minutes',
            'image' => 'https://placehold.co/600x400',
        ],
    ];
    ?>

    <div>
        <h2 class="h2">Featured Tutorials</h2>
        <p class="section-description">Find quick answers to common questions about using Orbuculum. From account setup
            to
            report export — here are the
            things users ask most often.</p>
    </div>

    <div class="tutorial-article-list">
        <?php foreach ($tutorials as $tutorial): ?>
            <?php
            $title = $tutorial['title'];
            $description = $tutorial['description'];
            $duration = $tutorial['duration'];
            $image = $tutorial['image'];
            include __DIR__ . '/../tutorials/item.php';

            ?>
        <?php endforeach; ?>
    </div>
    <?php
    $href = '/tutorials';
    $text = 'Browse all tutorials';
    include __DIR__ . '/../shared/more_link.php';
    ?>
</section>