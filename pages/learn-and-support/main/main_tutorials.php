<section class="spaced-content">
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