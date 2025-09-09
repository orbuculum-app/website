<?php
/**
 * Required variables:
 * - bool $stepsDisabled (optional, default true)
 * - string $markdown
 * - string $title
 */

$stepsDisabled = $stepsDisabled ?? false;

require_once __DIR__ . '/../../../../../vendor/autoload.php';
use cebe\markdown\GithubMarkdown;

$parser = new GithubMarkdown();
$parser->html5 = true;
$parser->keepHtml = true;

// Replace multiple blank lines in markdown with a gap marker
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
            include __DIR__ . "/../../shared/article/try_yourself.php";
            return ob_get_clean();
        case 'gallery':
            $rawLines = preg_split('/\r?\n/', $content);
            $imgs = [];
            foreach ($rawLines as $line) {
                $line = trim(strip_tags($line));
                if ($line !== '')
                    $imgs[] = $line;
            }
            if (empty($imgs))
                return '';
            $GLOBALS['prefixes'] = [];
            $GLOBALS['indexes_enabled'] = false;
            $GLOBALS['imgs'] = $imgs;
            ob_start();
            include __DIR__ . "/../../shared/photo_gallery.php";
            return ob_get_clean();
        case 'quote':
            $lines = explode("\n", trim($content));
            $h2 = array_shift($lines);
            $p = implode("\n", $lines);

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

$noStepsClass = $stepsDisabled ? 'article-page--no-steps' : '';
?>
<div class="article-page big-card <?= $noStepsClass ?>">
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const stepsDisabled = <?= $stepsDisabled ? 'true' : 'false' ?>;
        if (stepsDisabled) return;

        const stepsList = document.querySelector(".article-page__steps");
        let sectionIndex = 0;
        let stepIndex = 0;

        const firstH1 = document.querySelector(".article-page__content h1");
        if (firstH1) {
            sectionIndex++;
            const id = "section-" + sectionIndex;
            firstH1.setAttribute("id", id);
            stepsList.insertAdjacentHTML("beforeend", `
            <li class="article-page__step">
                <a href="#${id}" class="article-page__step-content">
                    <strong>Section ${sectionIndex}:</strong> Introduction
                </a>
            </li>
        `);
        }

        document.querySelectorAll(".article-page__content h2, .article-page__content h3").forEach(el => {
            const text = el.textContent.trim();
            let id;
            if (el.tagName.toLowerCase() === "h2") {
                sectionIndex++;
                stepIndex = 0;
                id = "section-" + sectionIndex;
                el.setAttribute("id", id);
                stepsList.insertAdjacentHTML("beforeend", `
                <li class="article-page__step">
                    <a href="#${id}" class="article-page__step-content">
                        <strong>Section ${sectionIndex}:</strong> ${text}
                    </a>
                </li>
            `);
            } else {
                stepIndex++;
                id = "step-" + sectionIndex + "-" + stepIndex;
                el.setAttribute("id", id);
                el.insertAdjacentHTML("afterbegin", `<span class="article-step-title__index">Step ${stepIndex}:</span>`);
                stepsList.insertAdjacentHTML("beforeend", `
                <li class="article-page__step article-page__step--small">
                    <a href="#${id}" class="article-page__step-content">
                        <strong>Step ${stepIndex}</strong>: ${text}
                    </a>
                </li>
            `);
            }
        });

        const navLinks = Array.from(document.querySelectorAll(".article-page__step-content"));

        function updateActiveLinks() {
            const viewportBottom = window.innerHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight;

            navLinks.forEach((link, index) => {
                const href = link.getAttribute("href");
                if (!href || !href.startsWith("#")) return;
                const section = document.querySelector(href);
                if (!section) return;

                const sectionRect = section.getBoundingClientRect();
                const hasScrolledPastOrReached = sectionRect.top < viewportBottom;
                const isLast = index === navLinks.length - 1;
                const nearBottom = scrollTop + window.innerHeight >= scrollHeight - 5;
                const stepItem = link.closest(".article-page__step");
                if (!stepItem) return;

                if (hasScrolledPastOrReached || (isLast && nearBottom)) {
                    stepItem.classList.add("active");
                } else {
                    stepItem.classList.remove("active");
                }
            });
        }

        navLinks.forEach(link => {
            link.addEventListener("click", (e) => {
                const targetId = link.getAttribute("href");
                const targetEl = document.querySelector(targetId);
                if (!targetEl) return;
                e.preventDefault();
                window.scrollTo({
                    top: targetEl.offsetTop - 20,
                    behavior: "smooth"
                });
            });
        });

        window.addEventListener("scroll", updateActiveLinks);
        window.addEventListener("resize", updateActiveLinks);
        updateActiveLinks();
    });
</script>