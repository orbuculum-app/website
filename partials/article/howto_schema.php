<?php
use Spatie\SchemaOrg\Schema;

/**
 * Render Schema.org HowTo markup for a guide page
 *
 * @param string $markdown Markdown content to parse
 * @return string Schema.org JSON-LD markup or empty string if not a guide
 */
function render_howto_schema(string $markdown): string {
    // Parse markdown to HTML to extract title and steps
    $article_html = parse_article_markdown($markdown);

    // Extract the first <h1> tag content for Schema.org HowTo name
    $title = '';
    if (preg_match('/<h1>(.*?)<\/h1>/', $article_html, $matches)) {
        $title = strip_tags($matches[1]); // Remove any nested HTML tags
    }

    // Extract steps from <h3> headings for Schema.org HowTo
    $steps = [];
    preg_match_all('/<h3>(.*?)<\/h3>/', $article_html, $h3_matches);
    foreach ($h3_matches[1] as $step_text) {
        $step_text = trim(strip_tags($step_text)); // Clean step text
        if (!empty($step_text)) {
            $steps[] = Schema::howToStep()
                ->name($step_text)
                ->text($step_text);
        }
    }

    // Generate Schema.org HowTo markup
    $howTo = Schema::howTo()
        ->name($title)
        ->description(''); // Empty description as requested
    if (!empty($steps)) {
        $howTo->step($steps);
    }

    // Return Schema.org JSON-LD
    return '<script type="application/ld+json">' . json_encode($howTo->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
}