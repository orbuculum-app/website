<?php
// Include SVG helper
require_once __DIR__ . '/../../../../resources/SvgHelper.php';

return [
    'title' => 'Platform',
    'subtitle' => 'Effortless Self-Management',
    'menu.items' => [
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_platform_icons_icon-1.svg', 'Platform Icon'),
            'title' => 'Solving Notebook / Spreadsheet Issues',
            'text' => 'Replaces notebooks/spreadsheets, transforming them into convenient and proper accounting.',
        ], [
            'icon' => getSvgImage('/svg/content_partials_submenus_platform_icons_icon-2.svg', 'Constructor Icon'),
            'title' => 'Constructor',
            'text' => 'Contains accounts and transactions between them, which can be assembled like ‘building blocks’. Built on the basis of double-entry accounting. If something has come in somewhere, it means it has gone out somewhere else, and vice versa.',
        ], [
            'icon' => getSvgImage('/svg/content_partials_submenus_platform_icons_icon-3.svg', 'Money Tracking Icon'),
            'title' => 'Shows where the money is',
            'text' => 'Transaction history, P&L, Cash Flow, Balances. Reports also display gains/losses on exchange rate differences and revaluations.',
        ], [
            'icon' => getSvgImage('/svg/content_partials_submenus_platform_icons_icon-4.svg', 'SQL Interface Icon'),
            'title' => 'SQL Interface & API',
            'text' => 'Not just an API, but also a SQL interface to client data, which enables the creation of custom reports/dashboards using external tools.',
        ],
    ],
    'menu.additional_items' => [
        'Flexible access control system',
        'Multi-currency support (even custom 😉)',
        'Projects',
        'Time zone support',
        'User action log',
        'Data import / export',
        'Recurring transactions',
        'Data expansion',
    ],
];