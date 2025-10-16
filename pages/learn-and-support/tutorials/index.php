<?php
require_once __DIR__ . '/tag.php';
include ROOT_PATH . 'content/pages/learn-and-support/tutorials.php';
include __DIR__ . '/../shared/intro.php';
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
            include __DIR__ . '/item.php';
            ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="faq-list big-card spaced-content" id="tutorials">
    <h2 class="h2">Related FAQ</h2>
    <?php
    include __DIR__ . '/../../learn-and-support/faq/list.php';
    ?>
    <?php
        $href = '/faqs';
        $text = 'See all FAQs';
        include __DIR__ . '/../shared/more_link.php';
    ?>
</section>
<section class="spaced-content">
    <h2 class="h2">Related How To</h2>
    <?php
    include ROOT_PATH . 'pages/learn-and-support/how-to/list.php';
    ?>
</section>

<?php
include __DIR__ . '/../shared/footer.php';
?>
