<section class="faq-list big-card spaced-content">
    <div>
        <h2 class="h2">Frequently Asked Questions</h2>
        <p class="section-description">Find quick answers to common questions about using Orbuculum.From account setup
            to
            report export — here are the things users ask most often.</p>
    </div>
    <?php
    $faq_list = [
        [
            'title' => 'How do I change my account settings?',
            'text' => 'Go to your account page, click "Settings", and update your details.',
        ],
        [
            'title' => 'Can I invite team members?',
            'text' => 'Yes, head to "Team Management" and use the "Invite Member" button.',
        ],
        [
            'title' => 'How to export my reports?',
            'text' => 'Go to the Reports section, select a range, and click "Export to PDF/CSV".',
        ],
    ];

    include __DIR__ . '../../../learn-and-support/faq/list.php';
    ?>
    <?php
    $href = '/faqs';
    $text = 'See all FAQs';
    include __DIR__ . '../../../learn-and-support/shared/more_link.php';
    ?>
</section>