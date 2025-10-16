<?php
use Spatie\SchemaOrg\Schema;

/** @var array $faq_list */
?>

<div class="faq-items">
    <?php foreach ($faq_list as $index => $faq): ?>
        <?php
        $title = $faq['title'];
        $text = $faq['text'];
        $id = $index + 1; // unique ID for aria-controls
        include __DIR__ . '/item.php';
        ?>
    <?php endforeach; ?>
</div>

<?php
$faqPage = Schema::faqPage();

foreach ($faq_list as $faq) {
    $faqPage->mainEntity(
            Schema::question()
                    ->name($faq['title'])
                    ->acceptedAnswer(
                            Schema::answer()->text($faq['text'])
                    )
    );
}

echo $faqPage->toScript();
?>
