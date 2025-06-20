const tooltipWrap = document.getElementById('_tooltip_container_wrap');
const tooltipDiv = document.getElementById('_tooltip_container');
let tooltipHoverTimeout;
let resizeTimer;

// Cache DOM elements on load to avoid repeated lookups
const DOM = {
    monthly: null,
    yearly: null,
    planItems: null,
    tooltips: null,
    rows: null,
    ultimatePlanFirstRow: null,
    otherPlanFirstRows: null,
    rowValues: null,
    header: null,
    faqItems: null,
    faqQuestions: null
};

// Prioritize critical rendering and defer non-critical operations
document.addEventListener('DOMContentLoaded', function () {
    // Immediately cache DOM elements and show content
    cacheElements();
    updatePlanVisibility();
    
    // Set up critical event listeners immediately
    if (DOM.monthly && DOM.yearly) {
        DOM.monthly.addEventListener('click', function(e) {
            e.preventDefault();
            togglePlanType('monthly');
        });
        
        DOM.yearly.addEventListener('click', function(e) {
            e.preventDefault();
            togglePlanType('yearly');
        });
    }
    
    // Defer remaining operations
    setTimeout(function() {
        // Set up remaining event listeners
        setupEventListeners();
    }, 50);
});

function cacheElements() {
    // Basic UI elements
    DOM.monthly = document.getElementById('__monthly');
    DOM.yearly = document.getElementById('__yearly');
    DOM.planItems = document.querySelectorAll('.plans__item');
    DOM.tooltips = document.querySelectorAll('.tooltip');
    
    // Cache plan items for better performance
    // Capture ALL rows, not just row-4
    DOM.rows = document.querySelectorAll('.plans__item-row');
    
    // Capture ALL first rows
    DOM.allFirstRows = document.querySelectorAll('.plans__item-row.__row-1');
    
    // Ultimate plan first row
    DOM.ultimatePlanFirstRow = document.querySelector('.plans__item._ultimate .__row-1');
    
    // Other plan first rows
    DOM.otherPlanFirstRows = document.querySelectorAll('.plans__item:not(.__header_column) .plans__item-row.__row-1');
    
    // Header column first row
    DOM.headerColumnFirstRow = document.querySelector('.plans__item.__header_column .plans__item-row.__row-1');
    
    // Row values for visibility
    DOM.rowValues = document.querySelectorAll('.row-value');
    
    // FAQ elements
    DOM.faqItems = document.querySelectorAll('.faq-item');
    DOM.faqQuestions = document.querySelectorAll('.faq-question');
}

function setupEventListeners() {
    // Set up FAQ accordion functionality
    setupFaqAccordion();
    
    // Optimize resize handler with a single efficient listener
    const optimizedResizeHandler = function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Store previous width to detect breakpoint crossings
            const prevWidth = window.lastWidth || window.innerWidth;
            const currentWidth = window.innerWidth;
            window.lastWidth = currentWidth;
            
            // Check if we're crossing a breakpoint boundary
            const wasMobile = prevWidth < 650;
            const isMobile = currentWidth < 650;
            const wasMedium = prevWidth >= 650 && prevWidth < 1150;
            const isMedium = currentWidth >= 650 && currentWidth < 1150;
            const wasLarge = prevWidth >= 1150;
            const isLarge = currentWidth >= 1150;
            
            // Check if we crossed a breakpoint
            const crossedBreakpoint = 
                (wasMobile && !isMobile) || 
                (wasMedium && !isMedium) || 
                (wasLarge && !isLarge);
            
            // Always update visibility and hide tooltips
            updatePlanVisibility();
            hideTooltip();
            

            // Force browser reflow for consistent rendering
            void document.documentElement.offsetHeight;
            
            // Very special handling for mobile devices
            if (isMobile) {
                // Force all first rows to auto height on mobile
                document.querySelectorAll('.plans__item-row.__row-1').forEach(row => {
                    row.style.removeProperty('height');
                    row.style.removeProperty('min-height');
                    row.style.removeProperty('max-height');
                    // Override any potential inline styles with !important via CSS class
                    row.classList.add('mobile-reset');
                });
            } else {
                // On medium and large screens, remove mobile-specific classes
                document.querySelectorAll('.mobile-reset').forEach(el => {
                    el.classList.remove('mobile-reset');
                });
                
                // Height adjustments on medium screens are now handled by prices_resize.js
            }
        }, 150);
    };
    
    window.addEventListener('resize', optimizedResizeHandler);
    
    // Optimize scroll handler
    const passiveScrollOpts = {passive: true};
    window.addEventListener('scroll', hideTooltip, passiveScrollOpts);
    
    // Set up tooltip events with event delegation when possible
    if (DOM.tooltips && DOM.tooltips.length > 0) {
        const tooltipContainer = DOM.tooltips[0].closest('.plans__list-grid');
        
        if (tooltipContainer) {
            // Use event delegation for tooltips
            tooltipContainer.addEventListener('mouseover', function(e) {
                const tooltip = e.target.closest('.tooltip');
                if (tooltip) {
                    showTooltip(tooltip);
                }
            });
            
            tooltipContainer.addEventListener('mouseout', function(e) {
                const tooltip = e.target.closest('.tooltip');
                if (tooltip) {
                    hideTooltip();
                }
            });
        } else {
            // Fallback to direct listeners if container not found
            DOM.tooltips.forEach(function(tooltip) {
                tooltip.addEventListener('mouseenter', function() {
                    showTooltip(this);
                });
                tooltip.addEventListener('mouseleave', hideTooltip);
            });
        }
    }
    
    // Functionality moved to prices_resize.js
    // Keep the load handler for compatibility
    window.addEventListener('load', function() {
        // Height adjustment now handled by prices_resize.js
    });
}

function updatePlanVisibility() {
    if (window.innerWidth < 1150) {
        hideEmptyValuesPlansList();
    } else {
        showEmptyValuesPlansList();
    }
}

function togglePlanType(type) {
    const isMonthly = type === 'monthly';
    const selectedBtn = isMonthly ? DOM.monthly : DOM.yearly;
    const otherBtn = isMonthly ? DOM.yearly : DOM.monthly;
    
    if (!selectedBtn.classList.contains('_selected')) {
        // Batch DOM operations
        requestAnimationFrame(function() {
            // Toggle button states
            selectedBtn.classList.add('_selected');
            otherBtn.classList.remove('_selected');
            
            // Prepare visibility changes
            const monthlyDisplay = isMonthly ? 'inline' : 'none';
            const yearlyDisplay = isMonthly ? 'none' : 'inline';
            
            // Apply all changes at once
            document.querySelectorAll('.__monthly').forEach(function(el) {
                el.style.display = monthlyDisplay;
            });
            
            document.querySelectorAll('.__yearly').forEach(function(el) {
                el.style.display = yearlyDisplay;
            });
            
            // Update the gap classes for all plan price divs based on payment mode
            document.querySelectorAll('.plans__item-price').forEach(function(priceDiv) {
                const currentGapClass = Array.from(priceDiv.classList).find(cls => cls.startsWith('gap-'));
                if (currentGapClass) {
                    priceDiv.classList.remove(currentGapClass);
                }
                
                const attributeName = isMonthly ? 'data-monthly-gap' : 'data-yearly-gap';
                const gapClass = priceDiv.getAttribute(attributeName) || 'gap-7';
                priceDiv.classList.add(gapClass);
            });
            

        });
    }
}


function hideEmptyValuesPlansList() {
    // Batch DOM operations
    const elementsToHide = [];
    
    // Read phase
    DOM.rowValues.forEach(function(elem) {
        if (elem.textContent === '') {
            elementsToHide.push(elem.closest('.plans__item-row'));
        }
    });
    
    // Write phase
    requestAnimationFrame(function() {
        elementsToHide.forEach(function(row) {
            row.style.display = 'none';
        });
    });
}

function showEmptyValuesPlansList() {
    // Batch write operations
    requestAnimationFrame(function() {
        DOM.rowValues.forEach(function(elem) {
            const row = elem.closest('.plans__item-row');
            if (row) {
                row.style.display = '';
            }
        });
    });
}

function showTooltip(targetElement) {
    const content = targetElement.dataset.tooltip;
    
    if (!content || content === '') {
        return;
    }
    
    // Clearing all positioning classes
    tooltipDiv.classList.remove('top', 'right', 'bottom', 'left');
    tooltipDiv.classList.add('top'); // Setting top positioning by default
    
    // Getting element position
    const targetElTooltipRect = targetElement.getBoundingClientRect();
    const scrollX = window.scrollX || window.pageXOffset;
    const scrollY = window.scrollY || window.pageYOffset;
    
    // Element center
    const elementCenterX = targetElTooltipRect.left + (targetElTooltipRect.width / 2);
    
    // Initial tooltip position (centered on the element)
    let leftPos = elementCenterX + scrollX;
    const topPos = (targetElTooltipRect.bottom + scrollY + 10);
    
    // Using requestAnimationFrame for optimization
    requestAnimationFrame(function() {
        // Setting content
        tooltipDiv.textContent = content;
        tooltipDiv.style.display = 'block';
        
        // Getting tooltip and window dimensions
        const tooltipRect = tooltipDiv.getBoundingClientRect();
        const windowWidth = window.innerWidth;
        
        // Setting tooltip width to 240px
        const tooltipWidth = 240;
        
        // Checking if tooltip extends beyond screen boundaries
        const tooltipLeftEdge = leftPos - (tooltipWidth / 2);
        const tooltipRightEdge = leftPos + (tooltipWidth / 2);
        
        // Checking left edge
        if (tooltipLeftEdge < scrollX + 20) {
            // Moving tooltip to the right to maintain 20px margin from left edge
            leftPos = scrollX + 20 + (tooltipWidth / 2);
        }
        
        // Checking right edge
        if (tooltipRightEdge > scrollX + windowWidth - 20) {
            // Moving tooltip to the left to maintain 20px margin from right edge
            leftPos = scrollX + windowWidth - 20 - (tooltipWidth / 2);
        }
        
        // If window is too narrow for tooltip with 20px margins on both sides
        if (windowWidth < tooltipWidth + 40) {
            // Centering tooltip in the middle of the screen
            leftPos = scrollX + (windowWidth / 2);
        }
        
        // Setting final tooltip position
        tooltipDiv.style.left = leftPos + 'px';
        tooltipDiv.style.top = topPos + 'px';
    });
}

function hideTooltip() {
    requestAnimationFrame(function() {
        tooltipDiv.textContent = '';
        tooltipDiv.style.top = '';
        tooltipDiv.style.left = '';
        tooltipDiv.style.display = 'none';
    });
}

// FAQ accordion functionality
function setupFaqAccordion() {
    if (!DOM.faqQuestions || DOM.faqQuestions.length === 0) return;
    
    DOM.faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.closest('.faq-item');
            const isActive = faqItem.classList.contains('active');
            
            // Toggle current FAQ item without closing others
            if (isActive) {
                faqItem.classList.remove('active');
            } else {
                faqItem.classList.add('active');
            }
        });
    });
}
