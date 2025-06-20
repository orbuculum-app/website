<?php
// Include SVG helper functions
require_once __DIR__ . '/../../resources/SvgHelper.php';

return [
    'title' => 'orbuculum',
    'icon.logo' => getSvgImage('/svg/content_partials_footer_icon_logo.svg', 'Orbuculum Logo', 'svg-icon', '27', '35'),
    'author_text' => '© 2025 Orbuculum. All rights reserved. Unauthorized reproduction, distribution, or modification of
                    any content, design, or functionality on this website is strictly prohibited. Orbuculum and its logo
                    are trademarks of Orbuculum. Use of this website constitutes acceptance of our Terms of Service and
                    Privacy Policy.',

    'icon.background_logo' => getSvgImage('/svg/content_partials_footer_icon_background_logo.svg', 'Orbuculum Background Logo', 'svg-icon', '537', '480')
];