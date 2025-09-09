<?php

require_once __DIR__ . '/../vendor/autoload.php';

use cebe\markdown\Markdown;

class CustomMarkdown extends Markdown
{
    /**
     * Register custom blocks
     */
    protected function identifyBlock($line, $lines, $current)
    {
        if (preg_match('/^:::(\w[\w\-]*)/', $line, $matches)) {
            return 'customBlock';
        }
        return parent::identifyBlock($line, $lines, $current);
    }

    /**
     * Parse custom block
     */
    protected function consumeCustomBlock($lines, $current)
    {
        $line = $lines[$current];
        preg_match('/^:::(\w[\w\-]*)/', $line, $matches);
        $blockType = $matches[1];

        $block = [
            'type' => 'customBlock',
            'blockType' => $blockType,
            'content' => [],
        ];

        $current++;

        while (isset($lines[$current]) && trim($lines[$current]) !== ':::') {
            $block['content'][] = $lines[$current];
            $current++;
        }

        return [$block, $current + 1];
    }

    /**
     * Render custom block
     */
    protected function renderCustomBlock($block)
    {
        $html = '';
        $inner = implode("\n", $block['content']);

        if ($block['blockType'] === 'block-list') {
            // Parse the inner Markdown
            $parsedList = $this->parse($inner);
            $html = "<ul class=\"block-list\">\n" . $parsedList . "\n</ul>";
        } else {
            // Fallback: render content as a <div>
            $parsedInner = $this->parse($inner);
            $html = "<div class=\"{$block['blockType']}\">\n" . $parsedInner . "\n</div>";
        }

        return $html;
    }
}
