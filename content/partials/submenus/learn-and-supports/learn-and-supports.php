<?php
// Include SVG helper
require_once __DIR__ . '/../../../../resources/SvgHelper.php';

return [
    'title' => 'Learn & Support',
    'subtitle' => 'Get Assistance and Support Here',
    'description' => 'Explore our extensive library of learning materials, including detailed tutorials and frequently asked questions, to quickly become proficient in using our platform. Our dedicated support team is also available around the clock to assist you with any queries or issues you may encounter.',
    'menu.items' => [
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_learn-and-supports_icons_how-to-icon.svg', 'How To Icon'),
            'title' => 'How to',
            'text' => 'Discover practical, easy-to-follow instructions for performing specific tasks and optimizing your use of our tools. Each guide is crafted to help you achieve success quickly and effectively, ensuring you make the most of our platform.'
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_learn-and-supports_icons_faq-icon.svg', 'FAQ Icon'),
            'title' => 'FAQ',
            'text' => 'Find quick answers to common questions and clear up any confusion with our comprehensive FAQ section. Designed to provide immediate assistance, this resource covers a wide range of topics to ensure smooth operation.'
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_learn-and-supports_icons_tutorials-icon.svg', 'Tutorials Icon'),
            'title' => 'Tutorials',
            'text' => 'Learn through step-by-step guides designed to help you master all features of our platform efficiently. Our tutorials offer detailed explanations and visual aids to enhance your understanding and skill set.'
        ],
        [
            'icon' => getSvgImage('/svg/content_partials_submenus_learn-and-supports_icons_cases-icon.svg', 'Cases Icon'),
            'title' => 'Cases',
            'text' => 'Explore real-world applications and success stories demonstrating how others have effectively utilized our services. These case studies provide proven strategies that can be applied to your own business scenarios.'
        ],
    ]
];