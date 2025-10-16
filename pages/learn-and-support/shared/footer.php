<?php
/** @var array $footer_links (each item: ['label' => ..., 'url' => ...]) */
?>

<footer class="help-footer big-card" aria-label="Help footer">
    <div class="help-footer__item help-footer__item--left spaced-content">
        <h2 class="h1">Still have questions?</h2>
        <div>
            <p>Didn’t find what you were looking for?</p>
            <p>Our team is here to help — just reach out and we’ll get back to you as soon as possible.</p>
        </div>

        <a href="<?= htmlspecialchars($button['url']) ?>" class="blue-button button button-blue">
            Send us a message
        </a>

        <?php if (!empty($footer_links)): ?>
            <div class="spaced-content">
                <p>Want to dig deeper? These links can help you find what you need.</p>
                <div>
                    <?php foreach ($footer_links as $link): ?>
                        <?php
                        $href = $link['url'];
                        $text = $link['label'];
                        include __DIR__ . "/../shared/more_link.php";
                        ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</footer>
