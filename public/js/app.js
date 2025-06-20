// Defer error handler setup to avoid blocking initial rendering
window.addEventListener('load', function() {
  window.onerror = function(message, source, lineno, colno, error) {
    console.error("Error:", message, "in file:", source, "at line:", lineno, "column:", colno);
    return true;
  };
});

// Use passive IIFE to avoid blocking the main thread
(function() {
  // Check WebP support only once
  if (sessionStorage.webpSupported !== undefined) {
    setBackgroundImages(sessionStorage.webpSupported === 'true');
    return;
  }
  
  // Function to check WebP support
  function checkWebpSupport(callback) {
    const img = new Image();
    img.onload = () => {
      const supported = img.width > 0 && img.height > 0;
      sessionStorage.webpSupported = supported;
      callback(supported);
    };
    img.onerror = () => {
      sessionStorage.webpSupported = false;
      callback(false);
    };
    img.src = 'data:image/webp;base64,UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==';
  }

  // Function to set background images with priority handling
  function setBackgroundImages(useWebp) {
    // Create a more efficient observer with options for better performance
    const observerOptions = {
      rootMargin: '200px 0px', // Load images 200px before they come into view
      threshold: 0.01 // Trigger when just 1% of the element is visible
    };
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const fallbackSrc = el.dataset.bgFallback;
          const webpSrc = el.dataset.bgWebp;
          const imageUrl = useWebp ? webpSrc : fallbackSrc;
          const isPriority = el.hasAttribute('data-priority');
          
          if (imageUrl) {
            // Use requestAnimationFrame for non-critical images
            if (isPriority) {
              el.style.backgroundImage = `url('${imageUrl}')`;
            } else {
              requestAnimationFrame(() => {
                el.style.backgroundImage = `url('${imageUrl}')`;
              });
            }
          }
          observer.unobserve(el);
        }
      });
    }, observerOptions);
    
    // Prioritize above-the-fold images
    const priorityImages = document.querySelectorAll('[data-bg-fallback][data-bg-webp][data-priority]');
    priorityImages.forEach(el => {
      const fallbackSrc = el.dataset.bgFallback;
      const webpSrc = el.dataset.bgWebp;
      const imageUrl = useWebp ? webpSrc : fallbackSrc;
      
      if (imageUrl) {
        el.style.backgroundImage = `url('${imageUrl}')`;
      }
    });
    
    // Observe all other images
    document.querySelectorAll('[data-bg-fallback][data-bg-webp]:not([data-priority])').forEach(el => {
      observer.observe(el);
    });
  }

  // Check WebP support and set backgrounds
  checkWebpSupport(function(isSupported) {
    // Execute after DOM is loaded
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => setBackgroundImages(isSupported));
    } else {
      setBackgroundImages(isSupported);
    }
  });
})();

/**
 * DOM utility functions for replacing jQuery
 */

/**
 * Select elements by CSS selector
 * @param {string} selector - CSS selector
 * @param {Element} [context=document] - Context to search within
 * @returns {Element|NodeList} - Element or NodeList of matching elements
 */
function select(selector, context = document) {
  const elements = context.querySelectorAll(selector);
  return elements.length === 1 ? elements[0] : elements;
}

/**
 * Add event listener with support for delegation
 * @param {Element} element - Element to attach the event to
 * @param {string} eventType - Type of event (click, input, etc.)
 * @param {string} [delegatedSelector] - CSS selector for delegation (optional)
 * @param {Function} callback - Event handler function
 */
function addEvent(element, eventType, delegatedSelector, callback) {
  // Handle case where delegatedSelector is omitted
  if (typeof delegatedSelector === 'function') {
    callback = delegatedSelector;
    delegatedSelector = null;
  }
  
  if (!element) return;
  
  // If we're using event delegation
  if (delegatedSelector) {
    element.addEventListener(eventType, function(event) {
      // Find all matching elements within the container
      const targets = Array.from(element.querySelectorAll(delegatedSelector));
      
      // Check if the event target or any of its parents match the delegatedSelector
      let currentTarget = event.target;
      while (currentTarget && currentTarget !== element) {
        if (targets.includes(currentTarget)) {
          // Call the callback with the correct 'this' context and event
          callback.call(currentTarget, event);
          return;
        }
        currentTarget = currentTarget.parentNode;
      }
    });
  } else {
    // Simple event binding without delegation
    element.addEventListener(eventType, callback);
  }
}

/**
 * Add class to element
 * @param {Element} element - DOM element
 * @param {string} className - Class name to add
 */
function addClass(element, className) {
  if (!element) return;
  element.classList.add(className);
}

/**
 * Remove class from element
 * @param {Element} element - DOM element
 * @param {string} className - Class name to remove
 */
function removeClass(element, className) {
  if (!element) return;
  element.classList.remove(className);
}

/**
 * Set CSS style on element
 * @param {Element} element - DOM element
 * @param {string} property - CSS property name
 * @param {string} value - CSS property value
 */
function setStyle(element, property, value) {
  if (!element) return;
  element.style[property] = value;
}

/**
 * Show element
 * @param {Element} element - DOM element
 */
function showElement(element) {
  if (!element) return;
  element.style.display = '';
}

/**
 * Hide element
 * @param {Element} element - DOM element
 */
function hideElement(element) {
  if (!element) return;
  element.style.display = 'none';
}

/**
 * Set text content of element
 * @param {Element} element - DOM element
 * @param {string} content - Text content to set
 */
function setText(element, content) {
  if (!element) return;
  element.textContent = content;
}

/**
 * Get or set value of form element
 * @param {Element} element - DOM element
 * @param {string} [value] - Value to set (if omitted, returns current value)
 * @returns {string|undefined} - Current value if getting
 */
function getValue(element, value) {
  if (!element) return '';
  
  // Get value
  if (value === undefined) {
    return element.value;
  }
  
  // Set value
  element.value = value;
}

/**
 * Get data attribute value
 * @param {Element} element - DOM element
 * @param {string} key - Data attribute name (without 'data-' prefix)
 * @returns {string} - Value of the data attribute
 */
function getData(element, key) {
  if (!element) return null;
  return element.dataset[key];
}

/**
 * Find closest ancestor matching selector
 * @param {Element} element - DOM element
 * @param {string} selector - CSS selector
 * @returns {Element|null} - Matching ancestor or null
 */
function findClosest(element, selector) {
  if (!element) return null;
  return element.closest(selector);
}

/**
 * Serialize form data to array of objects
 * @param {HTMLFormElement} form - Form element
 * @returns {Array} - Array of {name, value} objects
 */
function serializeForm(form) {
  if (!form || form.nodeName !== 'FORM') {
    return [];
  }
  
  return Array.from(new FormData(form).entries())
    .map(([name, value]) => ({ name, value }));
}

/**
 * Trim whitespace from string
 * @param {string} str - String to trim
 * @returns {string} - Trimmed string
 */
function trim(str) {
  return String(str).trim();
}

/**
 * Execute function when DOM is ready
 * @param {Function} callback - Function to execute
 */
function onReady(callback) {
  if (document.readyState !== 'loading') {
    callback();
  } else {
    document.addEventListener('DOMContentLoaded', callback);
  }
}

// Make utility functions globally available
window.select = select;
window.addEvent = addEvent;
window.addClass = addClass;
window.removeClass = removeClass;
window.setStyle = setStyle;
window.showElement = showElement;
window.hideElement = hideElement;
window.setText = setText;
window.getValue = getValue;
window.getData = getData;
window.findClosest = findClosest;
window.serializeForm = serializeForm;
window.trim = trim;
window.onReady = onReady;

/**
 * Ajax function to replace jQuery's $.ajax
 * @param {Object} options - Configuration options similar to jQuery's $.ajax
 * @param {string} options.url - The URL to send the request to
 * @param {string} options.method - The HTTP method to use (GET, POST, etc.)
 * @param {Object|FormData} options.data - Data to send with the request
 * @param {string} options.dataType - Expected response type (json, text, etc.)
 * @param {Object} options.xhrFields - Additional fields for the XHR object
 * @param {Function} options.beforeSend - Function to call before sending the request
 * @param {Function} options.success - Function to call on successful response
 * @param {Function} options.error - Function to call on error
 * @returns {XMLHttpRequest} - The XMLHttpRequest object
 */
function ajax(options) {
  // Create xhr object
  const xhr = new XMLHttpRequest();
  
  // Set method and URL
  const method = (options.method || 'GET').toUpperCase();
  const url = options.url;
  
  // Open the connection
  xhr.open(method, url, true);
  
  // Set xhrFields if provided (like withCredentials)
  if (options.xhrFields) {
    for (const field in options.xhrFields) {
      xhr[field] = options.xhrFields[field];
    }
  }
  
  // Set expected response type
  if (options.dataType === 'json') {
    xhr.responseType = 'json';
  }
  
  // Handle the response
  xhr.onload = function() {
    if (xhr.status >= 200 && xhr.status < 300) {
      // Success
      if (typeof options.success === 'function') {
        let response = xhr.response;
        
        // Parse JSON if needed and not already parsed
        if (options.dataType === 'json' && typeof response === 'string' && response) {
          try {
            response = JSON.parse(response);
          } catch (e) {
            console.error('Error parsing JSON response:', e);
          }
        }
        
        options.success(response, xhr.statusText, xhr);
      }
    } else {
      // Error
      if (typeof options.error === 'function') {
        options.error(xhr, xhr.statusText, xhr.response);
      }
    }
  };
  
  // Handle network errors
  xhr.onerror = function() {
    if (typeof options.error === 'function') {
      options.error(xhr, 'network_error', null);
    }
  };
  
  // Handle timeout
  xhr.ontimeout = function() {
    if (typeof options.error === 'function') {
      options.error(xhr, 'timeout', null);
    }
  };
  
  // Call beforeSend if provided
  if (typeof options.beforeSend === 'function') {
    options.beforeSend(xhr);
  }
  
  // Prepare and send data
  let requestData = null;
  
  if (options.data) {
    if (options.data instanceof FormData) {
      // FormData object can be sent directly
      requestData = options.data;
    } else if (typeof options.data === 'object') {
      // For POST requests with JSON data, set appropriate content type
      if (method === 'POST' || method === 'PUT') {
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        // Convert data object to URL-encoded string
        requestData = Object.keys(options.data)
          .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(options.data[key]))
          .join('&');
      } else {
        // For GET requests, append data to URL
        const queryString = Object.keys(options.data)
          .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(options.data[key]))
          .join('&');
        
        xhr.open(method, url + (url.includes('?') ? '&' : '?') + queryString, true);
      }
    }
  }
  
  // Send the request
  xhr.send(requestData);
  
  // Return the XHR object for potential abort
  return xhr;
}

// Make the ajax function globally available
window.ajax = ajax;
