<?php
use cebe\markdown\GithubMarkdown;

function parse_article_markdown(string $markdown): string {
    $parser = new GithubMarkdown();
    $parser->html5 = $parser->keepHtml = true;

    // Handle gaps
    $markdown = preg_replace("/\n{2,}/", "\n\n:::gap:::\n\n", $markdown);
    $html = $parser->parse($markdown);
    $html = str_replace('<p>:::gap:::</p>', '<div class="md-gap"></div>', $html);

    // Handle custom blocks
    return preg_replace_callback(
        '/:::([\w-]+)\s*(.*?):::/s',
        fn($m) => render_custom_block($m[1], $m[2], $parser),
        $html
    );
}

function render_custom_block(string $tag, string $content, GithubMarkdown $parser): string {
    $content = trim($content);
    $fileTag = str_replace('-', '_', $tag); // normalize for filenames

    switch ($tag) {
        case 'block-list':
        case 'try-yourself':
        case 'quote':
            ob_start();
            include ROOT_PATH . "partials/article/elements/{$fileTag}.php";
            return ob_get_clean();

        case 'youtube':
            $videoId = preg_replace('/[^a-zA-Z0-9_-]/', '', $content);
            ob_start();
            include ROOT_PATH . "partials/article/elements/youtube.php";
            return ob_get_clean();

        case 'gallery':
            $imgs = array_filter(array_map('trim', preg_split('/\r?\n/', strip_tags($content))));
            if (!$imgs) return '';
            ob_start();
            include ROOT_PATH . "partials/article/elements/photo_gallery.php";
            return ob_get_clean();

        default:
            if (preg_match('/-list$/', $tag)) {
                return '<ul class="' . htmlspecialchars($tag, ENT_QUOTES) . '">'
                    . $parser->parse($content)
                    . '</ul>';
            }
            return $content;
    }
}
