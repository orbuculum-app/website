<?php
// Include SVG helper
require_once __DIR__ . '/../../../../resources/SvgHelper.php';

return [
    'title' => 'Custom Products',
    'subtitle' => 'Let Us Handle What You Can Do Yourself',
    'menu.items' => [
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_custom-products_icons_custom-products-icon.svg', 'Custom Products Icon'),
            'title' => 'Custom Reports / Dashboards',
            'text' => '',
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_custom-products_icons_custom-calculation-automation-icon.svg', 'Custom Calculation Automation Icon'),
            'title' => 'Custom Calculation Automation',
            'text' => '',
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_custom-products_icons_individual-integration-icon.svg', 'Individual Integration Icon'),
            'title' => 'Individual integrations',
            'text' => '',
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_custom-products_icons_personalized-consulting-icon.svg', 'Personalized Consulting Icon'),
            'title' => 'Personalized Consulting',
            'text' => '',
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_custom-products_icons_data-extension-icon.svg', 'Data Extension Icon'),
            'title' => 'Data extension',
            'text' => '',
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_custom-products_icons_business-modeling-icon.svg', 'Business Modeling Icon'),
            'title' => 'Business modeling',
            'text' => '',
        ],
    ]
];