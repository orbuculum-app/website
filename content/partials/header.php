<?php
// Include SVG helper functions
require_once __DIR__ . '/../../resources/SvgHelper.php';

 return [
     'icon.dark_logo_orb' => getSvgImage('/svg/content_partials_header_icon_dark_logo_orb.svg', 'Orbuculum Logo', 'svg-icon', '22', '29'),

     'icon.arrow' => getSvgImage('/svg/header_menu_arrow_vector.svg', 'Arrow', 'svg-icon', '20', '20'),

     'menu.items' => [[
         'title' => 'Platform',
         'view_path' => '/submenus/platform.php',
         'id' => 'platform',
         'href' => null,
     ], [
         'title' => 'Custom Products',
         'view_path' => '/submenus/custom-products.php',
         'id' => 'custom_products',
         'href' => null,
     ], [
         'title' => 'Solutions',
         'view_path' => '/submenus/solutions.php',
         'id' => 'cases',
         'href' => null,
     ], [
         'title' => 'Learn & Support',
         'view_path' => '/submenus/learn-and-supports.php',
         'id' => 'learn_and_support',
         'href' => null,
     ], [
         'title' => 'Prices',
         'view_path' => null,
         'id' => null,
         'href' => '/prices.php'
     ]],

     'icon.login' => getSvgImage('/svg/content_partials_header_icon_login.svg', 'Login', 'svg-icon', '20', '20'),
     'icon.login_mobile' => getSvgImage('/svg/content_partials_header_icon_login_mobile.svg', 'Login', 'svg-icon', '35px', '35px'),
     'icon.home' => getSvgImage('/svg/content_partials_header_icon_home.svg', 'Home', 'svg-icon', '15', '15'),
     'icon.home_mobile' => getSvgImage('/svg/content_partials_header_icon_home_mobile.svg', 'Home', 'svg-icon', '33px', '35px')

 ];