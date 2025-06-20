<?php
// Include version.php to access the getSvgUrl function
require_once __DIR__ . '/../resources/AssetManager.php';

return [
    'site.title' => 'orbuculum',
    'site.logo_dark' => '',
    'site.logo_light' => '',
    'site.logo_dark_big' => '<img src="' . getSvgUrl('/svg/content_app_site_logo_dark_big.svg') . '" alt="Orbuculum Logo" class="svg-icon">' 
];