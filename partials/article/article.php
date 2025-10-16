<?php
/**
 * Render an article page.
 *
 * @param string $markdown The markdown content
 * @param string $title The article title
 * @param bool $stepsDisabled Whether to disable tutorial steps (default false)
 * @param string $page_type Optional page type (default 'guide')
 * @return void
 */

$stepsDisabled = $stepsDisabled ?? false;

require_once __DIR__ . '/parser.php';
require_once __DIR__ . '/howto_schema.php';

$article_html = parse_article_markdown($markdown);
$schema = render_howto_schema($markdown);

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
            <?= $article_html . "\n" . $schema ?? '' ?>
        </div>
    </article>
</div>
