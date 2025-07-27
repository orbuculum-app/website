<?php
require_once __DIR__ . '/../partials/feature/feature-template.php';

$allowed_pages = ['tutorials', 'how-to', 'use-case', 'faq'];
$page_name = (isset($_GET['page']) && in_array(basename($_GET['page']), $allowed_pages)) ? basename($_GET['page']) : '';
$current_page = $page_name;
$site_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';

$isArticlePage = !empty($_GET['article']);
$isMainPage = empty($_GET['page']);

function load_page_content($path)
{
    if (file_exists($path)) {
        ob_start();
        require $path;
        return ob_get_clean();
    }
    return null;
}

$page_content = $isMainPage
    ? load_page_content(__DIR__ . '/../content/pages/learn-and-support/main/index.php')
    : load_page_content(__DIR__ . "/../content/pages/learn-and-support/{$page_name}/index.php");

$breadcrumbs = [
    ['name' => 'Home', 'url' => $site_url, 'position' => 1],
    ['name' => 'Learn & Support', 'url' => $site_url . 'learn-and-support.php', 'position' => 2],
    ['name' => ucwords($page_name), 'url' => $site_url . 'learn-and-support.php?page=' . $page_name, 'position' => 3]
];

$current_url = $site_url . basename($_SERVER['PHP_SELF']);
if (!empty($_GET)) {
    $current_url .= '?' . http_build_query($_GET);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/head.php' ?>
    <?php foreach (['faq.js', 'learn-and-support/script.js', 'learn-and-support.js'] as $js): ?>
        <script type="module" src="js/<?= $js ?>?v=<?= $staticVersion ?>" defer></script>
    <?php endforeach; ?>
</head>

<body class="feature__page">
    <?php include '../partials/header/header.php' ?>
    <main class="features__container feature__container fx-column">
        <div class="content">
            <?php if (!$isMainPage): ?>
                <div
                    class="js-feature-header fx-row box fx-wrap f-s-12 feature-header <?= $isArticlePage ? 'feature-header--article' : '' ?>">
                    <nav class="relative breadcrumbs" aria-label="Breadcrumb">
                        <ul class="fx-row fx-wrap f-600" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <?php foreach ($breadcrumbs as $i => $crumb): ?>
                                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <?php if ($i < count($breadcrumbs) - 1): ?>
                                        <a itemprop="item" href="<?= htmlspecialchars($crumb['url']) ?>">
                                            <span itemprop="name"><?= htmlspecialchars($crumb['name']) ?></span>
                                        </a>
                                    <?php else: ?>
                                        <span class="js-current-nav fx-row fx-center current" itemprop="name">
                                            <?= htmlspecialchars($crumb['name']) ?>
                                            <span class="svg-wrapper">
                                                <svg class="icon" width="10" height="5" viewBox="0 0 10 5"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.75 0L4.875 3.125L8 0L9.25 0.625L4.875 5L0.5 0.625L1.75 0Z" />
                                                </svg>
                                            </span>
                                        </span>
                                    <?php endif; ?>
                                    <meta itemprop="position" content="<?= $crumb['position'] ?>" />
                                </li>
                                <?php if ($i < count($breadcrumbs) - 1)
                                    echo '<span>/</span>'; ?>
                            <?php endforeach; ?>
                            <a href="<?= htmlspecialchars($current_url) ?>" class="feature-header__article-title">
                                <?= htmlspecialchars(end($breadcrumbs)['name']) ?>
                            </a>
                        </ul>
                    </nav>

                    <?php $current_index = array_search($page_name, $allowed_pages); ?>
                    <nav class="fx-column fx-wrap f-500 feature-nav">
                        <a href="javascript:void(0)"
                            class="js-feature-prev svg-wrapper feature-nav__prev<?= $current_index === 0 ? ' disabled' : '' ?>"
                            data-page="<?= $current_index > 0 ? $allowed_pages[$current_index - 1] : '' ?>">
                            <!-- SVG left arrow -->
                            <svg width="22" height="8" viewBox="0 0 22 8" xmlns="http://www.w3.org/2000/svg" class="icon">
                                <path
                                    d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64645L3.82843 0.464466C4.02369 0.269204 4.34027 0.269204 4.53553 0.464466C4.7308 0.659728 4.7308 0.976311 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.7308 4.02369 7.7308 3.82843 7.53553L0.646446 4.35355ZM22 4V4.5H1V4V3.5H22V4Z" />
                            </svg>
                        </a>

                        <?php foreach ($allowed_pages as $p): ?>
                            <?php $active = $p === $page_name ? ' active' : ''; ?>
                            <a href="learn-and-support.php?page=<?= $p ?>" class="js-feature-nav feature-nav-item<?= $active ?>"
                                data-page="<?= $p ?>">
                                <?= ucwords(str_replace('-', ' ', $p)) ?>
                            </a>
                        <?php endforeach; ?>

                        <a href="javascript:void(0)"
                            class="js-feature-next svg-wrapper feature-nav__next<?= $current_index === count($allowed_pages) - 1 ? ' disabled' : '' ?>"
                            data-page="<?= $current_index < count($allowed_pages) - 1 ? $allowed_pages[$current_index + 1] : '' ?>">
                            <!-- SVG right arrow -->
                            <svg width="22" height="8" viewBox="0 0 22 8" xmlns="http://www.w3.org/2000/svg" class="icon">
                                <path
                                    d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64645L3.82843 0.464466C4.02369 0.269204 4.34027 0.269204 4.53553 0.464466C4.7308 0.659728 4.7308 0.976311 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.7308 4.02369 7.7308 3.82843 7.53553L0.646446 4.35355ZM22 4V4.5H1V4V3.5H22V4Z" />
                            </svg>
                        </a>
                    </nav>
                </div>
            <?php endif; ?>

            <div class="js-feature-container fx-column gap-40">
                <?php if ($page_name && !$isArticlePage): ?>
                    <?php foreach ($allowed_pages as $p): ?>
                        <?php
                        $content = load_page_content(__DIR__ . "/../content/pages/learn-and-support/$p/index.php");
                        if ($content):
                            echo "<article id='" . htmlspecialchars($p) . "' class='feature-article fx-column gap-40'>$content</article>";
                        endif;
                        ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?= $page_content ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer><?php include '../partials/footer/footer.php' ?></footer>
    <?php include '../partials/scripts.php' ?>
    <script src="js/feature-page.js?v=<?= $staticVersion ?>" defer></script>
    <script>
        window.allowedPages = <?= json_encode($allowed_pages) ?>;
        window.currentPage = 'learn-and-support';
        window.currentSubPage = '<?= $current_page ?>';
    </script>
</body>
</html>