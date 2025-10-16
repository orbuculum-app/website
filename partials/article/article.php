<?php
/**
 * Required variables:
 * - bool $stepsDisabled (optional, default true)
 * - string $markdown
 * - string $title
 */

$stepsDisabled = $stepsDisabled ?? false;

require_once __DIR__ . '/article_parser.php';

$article_html = parse_article_markdown($markdown);
$noStepsClass = $stepsDisabled ? 'article-page--no-steps' : '';
?>
<div id="article-page" class="article-page big-card <?= $noStepsClass ?>">
    <aside class="article-page__sidebar">
        <?php if (!$stepsDisabled): ?>
            <nav class="article-page__nav" aria-label="Tutorial steps">
                <ol class="article-page__steps"></ol>
            </nav>
        <?php endif; ?>
    </aside>

    <article class="article-page__content-wrapper">
        <div class="article-page__content">
            <?= $article_html ?? '' ?>
        </div>
    </article>
</div>
