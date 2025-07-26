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
        const wrapper = document.getElementsByClassName("article-page__content-wrapper")[0];

        function updateActiveLinks() {
            const viewportBottom = wrapper.clientHeight;

            navLinks.forEach((link, index) => {
                const href = link.getAttribute("href");
                if (!href || !href.startsWith("#")) return;

                const section = document.querySelector(href);
                if (!section) return;

                const sectionRect = section.getBoundingClientRect();
                const hasScrolledPastOrReached = sectionRect.top < viewportBottom;

                const isLast = index === navLinks.length - 1;
                const nearBottom =
                    wrapper.scrollTop + wrapper.clientHeight >= wrapper.scrollHeight - 5;

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
                wrapper.scrollTo({
                    top: targetEl.offsetTop - 20,
                    behavior: "smooth"
                });
            });
        });

        wrapper.addEventListener("scroll", updateActiveLinks);
        wrapper.addEventListener("resize", updateActiveLinks);
        updateActiveLinks();
    });
</script>