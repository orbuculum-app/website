<?php
/**
 * Required variables:
 * - array $steps
 * - string $content (HTML) – the actual article content
 */
?>
<?php
$noStepsClass = empty($steps) ? 'article-page--no-steps' : '';
?>
<div class="article-page big-card <?= $noStepsClass ?>">
    <?php if (!empty($steps)): ?>
        <aside class="article-page__sidebar">
            <nav class="article-page__nav" aria-label="Tutorial steps">
                <ol class="article-page__steps">
                    <?php foreach ($steps as $index => $step): ?>
                        <li class="article-page__step">
                            <a href="#step-<?= $index ?>" class="article-page__step-content">
                                <?= isset($step['is_intro']) && $step['is_intro']
                                    ? htmlspecialchars($step['title'])
                                    : "<strong>Section $index:</strong> " . htmlspecialchars($step['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </nav>
        </aside>
    <?php else: ?>
        <aside class="article-page__sidebar"></aside>
    <?php endif; ?>

    <article class="article-page__content-wrapper">
        <div class="article-page__content spaced-content">
            <?= $content ?? '' ?>
        </div>
    </article>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const navLinks = Array.from(document.querySelectorAll(".article-page__step-content"));

        function updateActiveLinks() {
            const viewportBottom = window.innerHeight; // correct property for viewport height
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop; // scroll position
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