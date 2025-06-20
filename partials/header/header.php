<?php
$config = include __DIR__ . '/../../config/config.php';
$headerContent = include __DIR__ . '/../../content/partials/header.php';
$siteContent = include __DIR__ . '/../../content/app.php';
?>

<header>
    <div class="header fx-column fx-center">
        <div class="header__content fx-row">
            <div class="header__logo fx-row"
                 onclick="window.open('/', '_self')">
                <div class="header__logo--desktop fx-row">
                    <?= $headerContent['icon.dark_logo_orb'] ?>
                    <span><?= $siteContent['site.title'] ?></span>
                </div>
                <div class="header__logo--mobile">
                    <?= $headerContent['icon.dark_logo_orb'] ?>
                </div>
            </div>
            <div class="mobile__menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <nav class="header__menu fx-row fx-center">
                <ul class="menu__list fx-row fx-center">
                    <?php foreach ($headerContent['menu.items'] as $menu): ?>
                        <li class="menu__item <?= isset($menu['view_path']) ? 'active' : '' ?>"
                            id="<?= isset($menu['id']) ? $menu['id'] : '' ?>">
                            <a class="menu__item--title fx-row fx-center" <?= $menu['href'] ? 'href=' . $menu['href'] : '' ?>>
                                <span><?= $menu['title'] ?></span>
                                <?php
                                if (isset($menu['view_path'])) {
                                    echo $headerContent['icon.arrow'];
                                } ?>
                            </a>
                            <?php
                            if (isset($menu['view_path'])) {
                                include_once __DIR__ . $menu['view_path'];
                            } ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="header__button fx-row" style="min-width:190px; justify-content: end">
                <div class="login__button hidden_btn fx-center fx-row" id="openModalBtn"
                     data-url="<?= $config['url'] ?>auth/login-ajax-wp">
                    <svg width="20" height="20" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="var(--color-alt-gray)"
                              d="M6.50008 0.125C5.67128 0.125 4.87642 0.45424 4.29037 1.04029C3.70432 1.62634 3.37508 2.4212 3.37508 3.25C3.37508 4.0788 3.70432 4.87366 4.29037 5.45971C4.87642 6.04576 5.67128 6.375 6.50008 6.375C7.32888 6.375 8.12374 6.04576 8.70979 5.45971C9.29584 4.87366 9.62508 4.0788 9.62508 3.25C9.62508 2.4212 9.29584 1.62634 8.70979 1.04029C8.12374 0.45424 7.32888 0.125 6.50008 0.125ZM3.16675 8.04167C2.33795 8.04167 1.54309 8.37091 0.957039 8.95696C0.370988 9.54301 0.041748 10.3379 0.041748 11.1667V12.1567C0.041748 12.785 0.496748 13.32 1.11675 13.4208C4.68175 14.0033 8.31841 14.0033 11.8834 13.4208C12.1835 13.372 12.4564 13.218 12.6533 12.9864C12.8503 12.7548 12.9584 12.4607 12.9584 12.1567V11.1667C12.9584 10.3379 12.6292 9.54301 12.0431 8.95696C11.4571 8.37091 10.6622 8.04167 9.83341 8.04167H9.55008C9.39591 8.04167 9.24258 8.06667 9.09675 8.11333L8.37508 8.34917C7.15671 8.74686 5.84345 8.74686 4.62508 8.34917L3.90341 8.11333C3.75729 8.06578 3.60458 8.04159 3.45091 8.04167H3.16675Z"/>
                    </svg>
                    <span>Log in</span>
                </div>
                <a href="<?= $config['url'] ?>" aria-label="Home">
                    <div class="home__button hidden_btn fx-center fx-row" id="homeBtn" data-url="<?= $config['url'] ?>"
                         style="max-width: 190px; width: max-content; padding: 0 11px">
                        <div id="__user_photo_div" class="fx-row txt-white fx-center" style="width: 20px; height: 20px"></div>
                        <svg id="__home_icon" width="20" height="20" viewBox="0 0 14 15" fill="none" style="display: none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill="var(--color-alt-gray)"
                                  d="M8.003 0.388113C7.72768 0.140748 7.37062 0.00390625 7.0005 0.00390625C6.63038 0.00390625 6.27332 0.140748 5.998 0.388113L0.498 5.33011C0.341441 5.47065 0.216195 5.64255 0.130399 5.83464C0.0446024 6.02674 0.00017425 6.23473 0 6.44511V13.5001C0 13.8979 0.158035 14.2795 0.43934 14.5608C0.720644 14.8421 1.10218 15.0001 1.5 15.0001H3.5C3.89782 15.0001 4.27936 14.8421 4.56066 14.5608C4.84196 14.2795 5 13.8979 5 13.5001V9.50011C5 9.36751 5.05268 9.24033 5.14645 9.14656C5.24021 9.05279 5.36739 9.00011 5.5 9.00011H8.5C8.63261 9.00011 8.75979 9.05279 8.85355 9.14656C8.94732 9.24033 9 9.36751 9 9.50011V13.5001C9 13.8979 9.15804 14.2795 9.43934 14.5608C9.72064 14.8421 10.1022 15.0001 10.5 15.0001H12.5C12.8978 15.0001 13.2794 14.8421 13.5607 14.5608C13.842 14.2795 14 13.8979 14 13.5001V6.44511C14 6.2348 13.9557 6.02686 13.8701 5.83477C13.7844 5.64268 13.6594 5.47074 13.503 5.33011L8.003 0.388113Z"/>
                        </svg>
                        <div id="__user_name" class="f-s-13" style="max-width: 120px; text-align: left;"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/modals/_login_modal.php' ?>
    <?php include_once __DIR__ . '/modals/_forget_modal.php' ?>
</header>
