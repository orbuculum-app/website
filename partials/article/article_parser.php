<?php
use cebe\markdown\GithubMarkdown;

/**
 * Parse article markdown into HTML
 *
 * @param string $markdown
 * @return string
 */

function parse_article_markdown(string $markdown): string {
    $parser = new GithubMarkdown();
    $parser->html5 = true;
    $parser->keepHtml = true;

    // Replace multiple blank lines with a gap marker
    $markdown = preg_replace("/\n{2,}/", "\n\n:::gap:::\n\n", $markdown);

    // Parse markdown into HTML
    $article_html = $parser->parse($markdown);

    // Replace gap marker with styled div
    $article_html = str_replace('<p>:::gap:::</p>', '<div class="md-gap"></div>', $article_html);

    // Handle custom blocks
    $article_html = preg_replace_callback('/:::([a-zA-Z0-9_-]+)\s*(.*?):::/s', function ($matches) use ($parser) {
        $tag = $matches[1];
        $content = trim($matches[2]);

        switch ($tag) {
            case 'block-list':
                return '<div class="block-list">' . $parser->parse($content) . '</div>';
            case 'youtube':
                $videoId = preg_replace('/[^a-zA-Z0-9_-]/', '', $content);
                return '<iframe id="ytplayer" type="text/html" width="100%" height="490px"
                            src="https://www.youtube.com/embed/' . $videoId . '?color=white"
                            frameborder="0" allowfullscreen></iframe>';
            case 'try_yourself':
                ob_start();
                include ROOT_PATH . "partials/article/elements/try_yourself.php";
                return ob_get_clean();
            case 'gallery':
                $rawLines = preg_split('/\r?\n/', $content);
                $imgs = [];
                foreach ($rawLines as $line) {
                    $line = trim(strip_tags($line));
                    if ($line !== '') $imgs[] = $line;
                }
                if (empty($imgs)) return '';
                $GLOBALS['prefixes'] = [];
                $GLOBALS['indexes_enabled'] = false;
                $GLOBALS['imgs'] = $imgs;
                ob_start();
                include ROOT_PATH . "partials/article/elements/photo_gallery.php";
                return ob_get_clean();
            case 'quote':
                return '<section class="article-page__quote big-card spaced-content h2">'
                    . $parser->parse($content)
                    . '<div class="article-page__quote-symbol">“</div>'
                    . '</section>';
            default:
                if (preg_match('/-list$/', $tag)) {
                    return '<ul class="' . htmlspecialchars($tag, ENT_QUOTES) . '">'
                        . $parser->parse($content) .
                        '</ul>';
                }
                return $content;
        }
    }, $article_html);

    return $article_html;
}
