<?php

require_once __DIR__ . '/../partials/feature/feature-template.php';

$allowed_pages = ['core-engine', 'reporting', 'automation', 'permissions', 'data-tools', 'api'];
$page_content = null;
$current_page = isset($_GET['page']) && in_array(basename($_GET['page']), $allowed_pages) ? basename($_GET['page']) : '';

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page_name = basename($_GET['page']);

    if (in_array($page_name, $allowed_pages)) {
        $file_path = __DIR__ . '/../content/pages/feature/' . $page_name . '.php';

        if (file_exists($file_path)) {
            $page_content = require $file_path;
        }
    }
}

if (isset($_GET['json']) && $_GET['json'] === 'true') {
    header('Content-Type: application/json');
    if ($page_content) {
        echo json_encode([
            'content' => $page_content,
            'html' => renderArticle($page_content, $page_name, $allowed_pages),
            'pageName' => $current_page
        ]);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => 'Page not found']);
    }
    exit();
}

$site_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
$breadcrumbs = [
    [
        'name' => 'Home',
        'url' => $site_url,
        'position' => 1
    ],
    [
        'name' => 'Features',
        'url' => $site_url . 'features.php',
        'position' => 2
    ],
    [
        'name' => ucwords($page_name),
        'url' => $site_url . 'features/feature?page=' . $page_name,
        'position' => 3
    ]
];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/head.php' ?>
</head>


<body class="feature__page">
    <?php include '../partials/header/header.php' ?>
    <!-- PAGE CONTENT SECTION -->
    <main class="features__container feature__container fx-column">
        <div class="content">

            <div class="js-feature-header fx-row box fx-wrap f-s-12 feature-header">
                <nav class="relative breadcrumbs" aria-label="Breadcrumb">
                    <ul class="fx-row fx-wrap f-600" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <?php foreach ($breadcrumbs as $index => $crumb): ?>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <?php if ($index < count($breadcrumbs) - 1): ?>
                                    <a itemprop="item" href="<?php echo htmlspecialchars($crumb['url']); ?>">
                                        <span itemprop="name"><?php echo htmlspecialchars($crumb['name']); ?></span>
                                    </a>
                                <?php else: ?>
                                    <span class="js-current-nav fx-row fx-center current" itemprop="name">
                                        <?php echo htmlspecialchars($crumb['name']); ?>
                                        <span class="svg-wrapper">
                                            <svg class="icon" width="10" height="5" viewBox="0 0 10 5" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.75 0L4.875 3.125L8 0L9.25 0.625L4.875 5L0.5 0.625L1.75 0Z" />
                                            </svg>
                                        </span>
                                    </span>
                                <?php endif; ?>
                                <meta itemprop="position" content="<?php echo $crumb['position']; ?>" />
                            </li>
                            <?php if ($index < count($breadcrumbs) - 1) echo '<span>/</span>'; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <nav class="fx-column fx-wrap f-500 feature-nav">
                    <?php $current_index = array_search($page_name, $allowed_pages); ?>

                    <a href="javascript:void(0)" class="js-feature-prev svg-wrapper feature-nav__prev<?php echo $current_index === 0 ? ' disabled' : ''; ?>" data-page="<?php echo $current_index > 0 ? $allowed_pages[$current_index - 1] : ''; ?>">
                        <svg width="22" height="8" viewBox="0 0 22 8" xmlns="http://www.w3.org/2000/svg" class="icon">
                            <path d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64645L3.82843 0.464466C4.02369 0.269204 4.34027 0.269204 4.53553 0.464466C4.7308 0.659728 4.7308 0.976311 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.7308 4.02369 7.7308 3.82843 7.53553L0.646446 4.35355ZM22 4V4.5H1V4V3.5H22V4Z" />
                        </svg>
                    </a>

                    <?php foreach ($allowed_pages as $page) {
                        $active = ($page === $page_name) ? ' active' : '';
                        echo "<a href='feature.php?page=$page' class='js-feature-nav feature-nav-item$active' data-page='$page'>" . ucwords(str_replace('-', ' ', $page)) . "</a>";
                    } ?>

                    <a href="javascript:void(0)" class="js-feature-next svg-wrapper feature-nav__next<?php echo $current_index === count($allowed_pages) - 1 ? ' disabled' : ''; ?>" data-page="<?php echo $current_index < count($allowed_pages) - 1 ? $allowed_pages[$current_index + 1] : ''; ?>">
                        <svg width="22" height="8" viewBox="0 0 22 8" xmlns="http://www.w3.org/2000/svg" class="icon">
                            <path d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64645L3.82843 0.464466C4.02369 0.269204 4.34027 0.269204 4.53553 0.464466C4.7308 0.659728 4.7308 0.976311 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.7308 4.02369 7.7308 3.82843 7.53553L0.646446 4.35355ZM22 4V4.5H1V4V3.5H22V4Z" />
                        </svg>
                    </a>
                </nav>
            </div>


            <div class="js-feature-container fx-column gap-50">

                <?php if ($page_content) {
                    echo '<article id="' . htmlspecialchars($current_page) . '" class="feature-article">';
                    echo renderArticle($page_content, $current_page, $allowed_pages);
                    echo '</article>';
                } else {
                    echo "<p>Page not found.</p>";
                } ?>

            </div>
        </div>
    </main>

    <footer>
        <?php include '../partials/footer/footer.php' ?>

        <script>
            window.allowedPages = <?php echo json_encode($allowed_pages); ?>;
            window.currentPage = '<?php echo $current_page; ?>';
        </script>
        <script src="js/feature-page.js?v=<?php echo $staticVersion; ?>" defer></script>
    </footer>

    <?php include '../partials/scripts.php' ?>

</body>

</html>