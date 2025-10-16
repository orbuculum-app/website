<article class="spaced-content">
    <?php
        require_once ROOT_PATH . "content/pages/learn-and-support/main.php";

        include __DIR__ . '/../shared/intro.php';
        include 'main_tutorials.php';
        include 'main_howtos.php';
        include 'main_faq.php';

        $title = "“Now I spend 3x less time preparing financial reports”";
        $text = "Before Orbuculum, I used to spend entire weekends trying to align data from different spreadsheets and prepare reports for our partners. Now everything is automated — I can generate accurate financial reports in minutes. This gives me more time to focus on growing the business, not just managing it.";
        $img = "https://placehold.co/700x1500";
        $author = "by Alex Popescu, Founder of GreenWorks Logistics";
        include __DIR__ . '/../use-case/quote.php';

        $links = [];
        include __DIR__ . '/../shared/footer.php';

?>
</article>
