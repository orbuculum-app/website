<?php
// Connecting new modules for resource management and CSS compilation
require_once __DIR__ . '/../resources/CssCompiler.php';
require_once __DIR__ . '/../resources/SvgHelper.php';

?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Preconnect to Google Fonts to speed up font loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Preload critical font files directly -->
    <link rel="preload" href="https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCu173w5aXp-p7K4KLg.woff2" as="font" type="font/woff2" crossorigin>
    
    <!-- Critical CSS first with preload for better performance -->
    <link rel="preload" href="build/<?= $cssFile ?>?v=<?php echo $staticVersion; ?>" as="style">
    <link rel="stylesheet" href="build/<?= $cssFile ?>?v=<?php echo $staticVersion; ?>">
    
    <!-- Favicon and app icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=<?php echo $staticVersion; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=<?php echo $staticVersion; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=<?php echo $staticVersion; ?>">
    <link rel="manifest" href="/site.webmanifest?v=<?php echo $staticVersion; ?>">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=<?php echo $staticVersion; ?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="black">
    
    <!-- Optimized font loading strategy with font-display: swap -->
    <style>
      /* Inline critical font styles */
      @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCu173w5aXp-p7K4KLg.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
      }
    </style>
    
    <!-- Asynchronous loading of the complete font stylesheet -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" 
          rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap"
          rel="stylesheet" media="print" onload="this.media='all'">
    
    <!-- Font loading script -->
    <script>
    (function() {
      // Only run font loading logic if fonts aren't already loaded
      if (sessionStorage.fontsLoadedCritical) {
        document.documentElement.classList.add('fonts-loaded');
        return;
      }
      
      // Immediately add class for fallback fonts
      document.documentElement.classList.add('fonts-loading');
      
      // Use Promise.race with timeout to prevent long blocking
      if ('fonts' in document) {
        Promise.race([
          document.fonts.ready,
          new Promise(resolve => setTimeout(resolve, 2000))
        ]).then(function() {
          document.documentElement.classList.add('fonts-loaded');
          document.documentElement.classList.remove('fonts-loading');
          sessionStorage.fontsLoadedCritical = true;
        });
      }
    })();
    </script>
    
    <!-- Fallback for browsers that don't support onload -->
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </noscript>

    <title>Orbuculum</title>
