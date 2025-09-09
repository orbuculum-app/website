<?php
/** @var string $title */
/** @var string $text */
?>

<div class="faq-item">
    <div class="faq-header">
        <div class="faq-question">
            <h3 class="f-600 f-s-16 txt-black"><?= $title ?></h3>
            <span class="faq-toggle">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg" class="faq-icon faq-plus">
                    <path d="M8 3.33337V12.6667" stroke="currentColor" stroke-width="1.5"
                          stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.33301 8H12.6663" stroke="currentColor" stroke-width="1.5"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg" class="faq-icon faq-minus">
                    <path d="M3.33301 8H12.6663" stroke="currentColor" stroke-width="1.5"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </div>
    </div>
    <div class="faq-content">
        <div class="faq-answer txt-alt-gray f-s-14 f-500">
            <?= $text ?>
        </div>
    </div>
</div>
