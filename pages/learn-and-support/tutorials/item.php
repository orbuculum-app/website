<?php
/** @var string $title */
/** @var string $description */
/** @var string $duration */
/** @var string $image */
/** @var string|null $tag */
/** @var string $href */
?>

<a
        <?= isset($tag) ? 'data-tag="' . htmlspecialchars($tag->value) . '"' : '' ?>
        href="<?= htmlspecialchars($href) ?>"
        class="tutorial-article card"
        itemscope itemtype="https://schema.org/CreativeWork"
>
    <div class="tutorial-article__image responsive-image">
        <button class="tutorial-article__button" aria-label="Play tutorial">
            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.3571 8.70711C16.7476 8.31658 16.7476 7.68342 16.3571 7.29289L9.99312 0.928932C9.6026 0.538408 8.96943 0.538408 8.57891 0.928932C8.18838 1.31946 8.18838 1.95262 8.57891 2.34315L14.2358 8L8.57891 13.6569C8.18838 14.0474 8.18838 14.6805 8.57891 15.0711C8.96943 15.4616 9.6026 15.4616 9.99312 15.0711L16.3571 8.70711ZM0.349976 8V9H15.65V8V7H0.349976V8Z" fill="#2AA7EE"/>
            </svg>
        </button>
        <img
                src="<?= htmlspecialchars($image) ?>"
                alt="<?= htmlspecialchars($title) ?> tutorial image"
                itemprop="image"
        />
    </div>

    <div class="tutorial-article__content spaced-content">
        <h3 class="tutorial-article__title" itemprop="headline">
            <?= htmlspecialchars($title) ?>
        </h3>
        <p class="tutorial-article__description" itemprop="description">
            <?= htmlspecialchars($description) ?>
        </p>

        <div class="tutorial-article__duration">
            <span class="tutorial-article__duration-icon" aria-hidden="true">
                <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.5 3.5C7.88932 3.5 9.07455 4.07867 9.95962 4.71217C10.8503 5.34858 11.4934 6.08008 11.809 6.47558C11.9335 6.63086 12 6.81334 12 7C12 7.18666 11.9335 7.36914 11.809 7.52442C11.4934 7.91992 10.8503 8.65142 9.95962 9.28783C9.07385 9.92133 7.88932 10.5 6.5 10.5C5.11068 10.5 3.92545 9.92133 3.04038 9.28783C2.1497 8.65083 1.50659 7.91933 1.19099 7.52383C1.06646 7.36855 1 7.18608 1 6.99942C1 6.81276 1.06646 6.63028 1.19099 6.475C1.50659 6.08008 2.1497 5.34858 3.04038 4.71217C3.92615 4.07867 5.11068 3.5 6.5 3.5ZM2.06695 6.96033C2.0573 6.972 2.05213 6.98584 2.05213 7C2.05213 7.01416 2.0573 7.028 2.06695 7.03967C2.35519 7.4025 2.93729 8.0605 3.72627 8.62458C4.51947 9.19217 5.46695 9.625 6.5 9.625C7.53305 9.625 8.48123 9.19217 9.27373 8.62458C10.062 8.0605 10.6441 7.40192 10.9331 7.03967C10.9427 7.028 10.9479 7.01416 10.9479 7C10.9479 6.98584 10.9427 6.972 10.9331 6.96033C10.6441 6.59808 10.062 5.9395 9.27373 5.37542C8.48053 4.80783 7.53305 4.375 6.5 4.375C5.46695 4.375 4.51877 4.80783 3.72627 5.37542C2.93799 5.9395 2.35589 6.59808 2.06695 6.96033ZM6.5 8.16667C6.31321 8.17018 6.12746 8.14262 5.95365 8.0856C5.77985 8.02858 5.62149 7.94326 5.48787 7.83463C5.35426 7.72601 5.24808 7.59627 5.17557 7.45305C5.10307 7.30982 5.06569 7.15599 5.06565 7.00059C5.0656 6.84519 5.10288 6.69134 5.1753 6.54808C5.24772 6.40483 5.35382 6.27505 5.48737 6.16637C5.62092 6.05769 5.77923 5.9723 5.953 5.91521C6.12677 5.85812 6.31251 5.83048 6.4993 5.83392C6.86578 5.84066 7.21453 5.96646 7.47089 6.18441C7.72725 6.40235 7.87084 6.6951 7.87093 7.00001C7.87102 7.30491 7.72761 7.59772 7.47138 7.81577C7.21515 8.03382 6.86648 8.15977 6.5 8.16667Z" fill="#555F87"/>
                </svg>
            </span>
            <span itemprop="timeRequired"><?= htmlspecialchars($duration) ?></span>
        </div>
    </div>
</a>
