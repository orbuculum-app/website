<?php
/** @var string $title */
/** @var string $text */
/** @var string $author */
/** @var string $img */
/** @var string $category */
/** @var string $related_page */
?>

<figure class="big-card quote" aria-labelledby="quote-title-<?= md5($title) ?>">
    <blockquote class="quote__item quote__content spaced-content" role="quote">
        <div class="quote__tag"><?= htmlspecialchars($category ?? 'Use Case') ?></div>
        <h3 id="quote-title-<?= md5($title) ?>" class="h2"><?= htmlspecialchars($title) ?></h3>
        <p class="quote__text"><?= htmlspecialchars($text ?? '') ?></p>
        <footer class="italic">by <?= htmlspecialchars($author) ?></footer>
        <?php if(!empty($related_page)): ?>
            <a href="<?= htmlspecialchars($related_page) ?>" class="quote__link">Learn more about <?= htmlspecialchars($title) ?></a>
        <?php endif; ?>
    </blockquote>

    <figcaption class="quote__item quote__img">
        <img src="<?= htmlspecialchars($img) ?>"
             srcset="<?= htmlspecialchars($img) ?> 1x, <?= htmlspecialchars(str_replace('.jpg', '@2x.jpg', $img)) ?> 2x"
             sizes="(max-width: 600px) 100vw, 50vw"
             alt="Illustration for <?= htmlspecialchars($title) ?> by <?= htmlspecialchars($author) ?>"
             loading="lazy" />
    </figcaption>

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Quotation",
          "name": "<?= htmlspecialchars($title) ?>",
      "text": "<?= htmlspecialchars($text ?? '') ?>",
      "author": {
        "@type": "Person",
        "name": "<?= htmlspecialchars($author) ?>"
      },
      "image": "<?= htmlspecialchars($img) ?>",
      "url": "<?= htmlspecialchars($related_page ?? '') ?>"
    }
    </script>
</figure>
