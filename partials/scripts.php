<?php
require_once __DIR__ . '/../resources/AssetManager.php';
?>

<!-- Add script loading priority hints -->
<script type="module" src="js/header/header.js?v=<?php echo $staticVersion; ?>" defer fetchpriority="low"></script>
<!-- Modal scripts loaded dynamically to improve initial page load -->
<script>
// Dynamically load modal scripts when needed
document.addEventListener('DOMContentLoaded', function() {
    // Find the login button
    const loginButton = document.querySelector('.login__button');
    
    if (loginButton) {
        // Prefetch (instead of preload) modal scripts when user hovers over login button
        // This tells the browser these resources might be needed soon, but without the strict timing requirements of preload
        const prefetchModals = function() {
            // Create link prefetch elements for the modal scripts
            const prefetchForget = document.createElement('link');
            prefetchForget.rel = 'prefetch';
            prefetchForget.href = 'js/header/modals/_forget_modal.js?v=<?php echo $staticVersion; ?>';
            document.head.appendChild(prefetchForget);
            
            const prefetchLogin = document.createElement('link');
            prefetchLogin.rel = 'prefetch';
            prefetchLogin.href = 'js/header/modals/_login_modal.js?v=<?php echo $staticVersion; ?>';
            document.head.appendChild(prefetchLogin);
            
            // Remove event listener after prefetching
            loginButton.removeEventListener('mouseenter', prefetchModals);
        };
        
        // Prefetch on hover - this is the most likely time when user will need these resources
        loginButton.addEventListener('mouseenter', prefetchModals);
        
        // Load scripts on click
        loginButton.addEventListener('click', function(e) {
            // Prevent default action until scripts are loaded
            e.preventDefault();
            
            // Function to load a script dynamically
            const loadScript = function(src) {
                return new Promise((resolve, reject) => {
                    const script = document.createElement('script');
                    script.type = 'module';
                    script.src = src;
                    script.onload = resolve;
                    script.onerror = reject;
                    document.body.appendChild(script);
                });
            };
            
            // Load both scripts and then trigger click event
            Promise.all([
                loadScript('js/header/modals/_forget_modal.js?v=<?php echo $staticVersion; ?>'),
                loadScript('js/header/modals/_login_modal.js?v=<?php echo $staticVersion; ?>')
            ]).then(() => {
                // Show modal after scripts are loaded
                $('#myModal').css('display', 'flex');
            }).catch(error => {
                console.error('Error loading modal scripts:', error);
            });
        });
    }
});
</script>

<script type="module" src="js/app.js?v=<?php echo $staticVersion; ?>" defer></script>

<!-- Add performance monitoring script -->
<script>
// Simple performance monitoring
if (window.performance && window.performance.timing) {
    window.addEventListener('load', function() {
        setTimeout(function() {
            const timing = window.performance.timing;
            const pageLoadTime = timing.loadEventEnd - timing.navigationStart;
            console.log('Page load time:', pageLoadTime + 'ms');
            
            // Report specific render metrics if available
            if (window.performance.getEntriesByType) {
                const paintMetrics = window.performance.getEntriesByType('paint');
                paintMetrics.forEach(function(paintMetric) {
                    console.log(paintMetric.name + ':', Math.round(paintMetric.startTime) + 'ms');
                });
            }
        }, 0);
    });
}
</script>
