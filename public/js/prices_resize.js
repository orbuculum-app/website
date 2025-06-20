/**
 * prices_resize.js
 * Focused script that only handles resizing of the Growth plan on medium screens
 * It will adjust the Growth plan height based on the Ultimate plan's height
 */

(function() {

    const BREAKPOINTS = {
        MOBILE_MAX: 649,
        MEDIUM_MIN: 650,
        MEDIUM_MAX: 1149,
        LARGE_MIN: 1150
    };


    const elements = {
        growthPlanFirstRow: null,
        ultimatePlanFirstRow: null,
        headerFirstRow: null
    };


    let heightObserver = null;
    

    let resizeTimer = null;


    function init() {

        // Window load event ensures all resources (images, etc.) are loaded
        if (document.readyState === 'complete') {

            setTimeout(initWithRetry, 10); // Small delay for browser to stabilize
        } else {

            window.addEventListener('load', function() {

                setTimeout(initWithRetry, 100);
            });
            

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {

                    setTimeout(function() {

                        cacheElements();
                    }, 50);
                });
            }
        }
    }
    

    function initWithRetry(retryCount = 0) {

        cacheElements();
        

        if (!elements.growthPlanFirstRow || !elements.ultimatePlanFirstRow) {
            if (retryCount < 3) { // Retry up to 3 times
                setTimeout(() => initWithRetry(retryCount + 1), (retryCount + 1) * 200);
                return;
            } else {
                console.warn('Growth or Ultimate plan elements not found. Height adjustment disabled.');
            }
        }
        

        initOnDOMReady();
    }


    function initOnDOMReady() {

        cacheElements();
        

        if (!elements.growthPlanFirstRow || !elements.ultimatePlanFirstRow) {
            console.warn('Growth or Ultimate plan elements not found. Height adjustment disabled.');
            return;
        }
        

        // This ensures all styles and images are loaded
        setTimeout(() => {

            if (isCurrentlyMediumScreen()) {
                adjustGrowthPlanHeight();
            }
        }, 100);
        

        window.addEventListener('resize', handleResize, {passive: true});
        

        window.addEventListener('load', () => {
            if (isCurrentlyMediumScreen()) {
                adjustGrowthPlanHeight();
            }
        });

        // Listen for plan type toggle (monthly/yearly) 
        document.addEventListener('click', event => {
            // Check if the clicked element is a plan type toggle button
            if (event.target.matches('#__monthly, #__yearly')) {
                // Apply after a short delay to allow other DOM changes
                setTimeout(() => {
                    if (isCurrentlyMediumScreen()) {
                        adjustGrowthPlanHeight();
                    }
                }, 50);
            }
        });
    }


    function cacheElements() {
        // Try to find Growth plan with different selectors to ensure we get it
        elements.growthPlanFirstRow = document.querySelector('.plans__item._pro .plans__item-row.__row-1');
        const growthAlt = document.querySelector('.plans__item._growth .plans__item-row.__row-1');
        
        // If not found by class, try using position (2nd plan)
        if (!elements.growthPlanFirstRow && !growthAlt) {
            const allPlans = Array.from(document.querySelectorAll('.plans__item:not(.__header_column)'));
            if (allPlans.length >= 2) {
                elements.growthPlanFirstRow = allPlans[1]?.querySelector('.plans__item-row.__row-1') || null;
            }
        } else if (growthAlt) {
            elements.growthPlanFirstRow = growthAlt;
        }
        
        // Similar approach for Ultimate plan
        elements.ultimatePlanFirstRow = document.querySelector('.plans__item._ultimate .plans__item-row.__row-1');
        
        // If not found, try by position (3rd plan)
        if (!elements.ultimatePlanFirstRow) {
            const allPlans = Array.from(document.querySelectorAll('.plans__item:not(.__header_column)'));
            if (allPlans.length >= 3) {
                elements.ultimatePlanFirstRow = allPlans[2]?.querySelector('.plans__item-row.__row-1') || null;
            }
        }
        
        // Find header column
        elements.headerFirstRow = document.querySelector('.plans__item.__header_column .plans__item-row.__row-1');
    }


    function isCurrentlyMediumScreen() {
        const width = window.innerWidth;
        return width >= BREAKPOINTS.MEDIUM_MIN && width <= BREAKPOINTS.MEDIUM_MAX;
    }


    function handleResize() {
        clearTimeout(resizeTimer);
        
        resizeTimer = setTimeout(() => {
            if (isCurrentlyMediumScreen()) {

                adjustGrowthPlanHeight();
            } else {

                resetHeights();
            }
        }, 150); // 150ms debounce
    }


    function resetHeights() {
        if (elements.growthPlanFirstRow) {
            elements.growthPlanFirstRow.style.removeProperty('height');
        }
        
        if (elements.headerFirstRow) {
            elements.headerFirstRow.style.removeProperty('height');
        }
    }


    function adjustGrowthPlanHeight() {

        if (!isCurrentlyMediumScreen()) {
            return;
        }
        

        if (!elements.ultimatePlanFirstRow || !elements.growthPlanFirstRow) {
            cacheElements();
            

            if (!elements.ultimatePlanFirstRow || !elements.growthPlanFirstRow) {
                console.warn('Cannot adjust heights: Growth or Ultimate plan elements not found.');
                return;
            }
        }
        

        elements.ultimatePlanFirstRow.style.removeProperty('height');
        

        void elements.ultimatePlanFirstRow.offsetHeight;
        
        // Use computedStyle as the primary measurement - it's most reliable
        const computedStyle = window.getComputedStyle(elements.ultimatePlanFirstRow).height;
        // Convert from string (e.g. "380px") to number
        let ultimateHeight = parseInt(computedStyle) || 0;
        
        // Only use scrollHeight as backup if computedStyle is unreliable
        if (!ultimateHeight || ultimateHeight < 50) {
            ultimateHeight = elements.ultimatePlanFirstRow.scrollHeight;
        }
        
        // Safety check for valid height
        if (!ultimateHeight || ultimateHeight < 50) {
            console.warn(`Ultimate height (${ultimateHeight}px) seems too small, using fallback height`);
            ultimateHeight = 380; // Fallback height based on CSS
        }
        
        // Use exact height without buffer
        // The Ultimate plan already has proper sizing, so we just match it exactly
        const targetHeight = ultimateHeight;
        
        // Apply to Growth plan and header column using requestAnimationFrame for better performance
        requestAnimationFrame(() => {
            // Apply to Growth plan
            elements.growthPlanFirstRow.style.height = targetHeight + 'px';
            
            // Apply to header column if it exists
            if (elements.headerFirstRow) {
                elements.headerFirstRow.style.height = targetHeight + 'px';
            }
        });
    }


    init();
})();
