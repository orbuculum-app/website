// Cache DOM elements
const DOM = {
    header: null,
    mobileMenu: null,
    headerMenu: null,
    menuItems: null,
    submenus: null,
    menuTitles: null,
    loginButton: null,
    homeButton: null
};

// Debounce function to limit expensive operations
function debounce(func, wait) {
    let timeout;
    return function() {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            func.apply(context, args);
        }, wait);
    };
}

// Remove login check from critical path completely
function setupLoginCheck() {
    // Only set up login check after window fully loads
    window.addEventListener('load', function() {
        // Minimal delay to ensure it's not part of critical path
        setTimeout(function() {
            // Use the real implementation after page load
            realCheckLoginStatus();

            // Add debug log to verify function is called
            console.log('Login check setup complete');
        }, 1); // Set delay to 1ms for immediate execution after load
    });
}

// Global variable to store window width
let windowWidth = window.innerWidth;

document.addEventListener('DOMContentLoaded', function () {
    cacheElements();

    let lastScrollTop = 0;

    window.addEventListener('resize', debounce(function () {
        windowWidth = window.innerWidth;
    }, 150));

    setupClickHandlers();

    setupLoginCheck();

    window.addEventListener("scroll", debounce(function () {
        requestAnimationFrame(function() {
            handleScroll(lastScrollTop);
            lastScrollTop = window.scrollY;
        });
    }, 10));
});

function cacheElements() {
    DOM.header = document.querySelector('div.header');
    DOM.mobileMenu = document.querySelector('.mobile__menu');
    DOM.headerMenu = document.querySelector('.header__menu');
    DOM.menuItems = document.querySelectorAll('.menu__item');
    DOM.submenus = document.querySelectorAll('.submenu');
    DOM.menuTitles = document.querySelectorAll('.menu__item--title');
    DOM.loginButton = document.querySelector('.login__button');
    DOM.homeButton = document.querySelector('.home__button');
    DOM.placeholderButton = document.querySelector('.placeholder__button');
    DOM.homeBtnUserName = document.getElementById('__user_name');
    DOM.homeBtnUserPhoto = document.getElementById('__user_photo_div');
    DOM.homeBtnIcon = document.getElementById('__home_icon');
    DOM.placeholderButton = document.querySelector('.placeholder__button');

    // Hide both buttons immediately to prevent flashing
    if (DOM.loginButton) addClass(DOM.loginButton, 'hidden_btn');
    if (DOM.homeButton) addClass(DOM.homeButton, 'hidden_btn');

    if (!DOM.placeholderButton && DOM.loginButton) {
        const headerButton = DOM.loginButton.parentElement;
        if (headerButton) {
            const placeholderButton = document.createElement('div');
            placeholderButton.className = 'placeholder__button flex-center';

            headerButton.insertBefore(placeholderButton, DOM.loginButton);
            DOM.placeholderButton = placeholderButton;
        }
    }
}

function setupClickHandlers() {
    // Document click handler
    document.addEventListener('click', function (e) {
        const target_click = e.target;

        const currentWindowWidth = windowWidth;

        if (findClosest(target_click, '.menu__item')) {
            console.log('click1');
            if (currentWindowWidth >= 900 && target_click.closest('.submenu')) return;

            const menuItem = target_click.closest('.menu__item');
            if (!menuItem) return;

            const target_submenu = menuItem.querySelector('.submenu');

            if (target_submenu) {
                // Immediately disable debounce for this operation for faster UI response
                DOM.submenus.forEach(el => {
                    if (target_submenu.id !== el.id) {
                        el.classList.remove('menu_show');
                    }
                });
                target_submenu.classList.toggle('menu_show');
            }

            if (currentWindowWidth < 900) {
                const target_menu_title = menuItem.querySelector('.menu__item--title');
                if (!target_menu_title) return;

                // Apply immediately without delays for better UX
                DOM.menuTitles.forEach(el => {
                    if (el !== target_menu_title) {
                        el.classList.remove('active');
                    }
                });
                target_menu_title.classList.toggle('active');
            }
        }
        else if (!findClosest(target_click, '.submenu')) {
            console.log('click no menu2');
            // Batch DOM operations
            requestAnimationFrame(function() {
                DOM.submenus.forEach(el => el.classList.remove('menu_show'));
            });
        }
    });

    // Mobile menu click handler
    if (DOM.mobileMenu) {
        DOM.mobileMenu.addEventListener('click', function () {
            if (window.innerWidth < 900) {
                console.log('click mob menu');
                // Apply changes immediately for better response
                DOM.submenus.forEach(el => el.classList.remove('menu_show'));
                DOM.menuTitles.forEach(el => el.classList.remove('active'));
                DOM.mobileMenu.classList.toggle('active');

                if (DOM.headerMenu) {
                    DOM.headerMenu.classList.toggle('_show');
                }
            }
        });
    }
}


function checkLoginStatus() {
    console.log('Initial checkLoginStatus called - this should not execute');
    // Do nothing in the initial load
}


function realCheckLoginStatus() {
    console.log('Real checkLoginStatus called');

    if (!DOM.loginButton) {
        console.log('DOM.loginButton not found');
        return;
    }

    const url = getData(DOM.loginButton, 'url');
    console.log('Login URL:', url);

    if (!url) {
        console.log('URL not found in data-url attribute');
        return;
    }

    // No caching of login status - always check on page load

    let timeoutId;

    ajax({
        url: url + '?isLogged=true',
        method: 'GET',
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        beforeSend: function() {
            // Set timeout for the request
            timeoutId = setTimeout(function() {
                console.log('Login status request timed out');

                // Default to showing login button on timeout
                updateLoginUI(false);
            }, 3000); // 3 second timeout
        },
        success: function(data) {
            clearTimeout(timeoutId);
            console.log('Login status response:', data);

            // Process the response
            if (data && typeof data.logged !== 'undefined') {
                // Update UI based on login status
                updateLoginUI(data.logged === true);

                if (data.logged === true) {
                    let user_name_matched =  data.content.user_name.match(/[\p{L}\p{N}]/u);

                    // SET TEXT IN HOME BTN
                    if (user_name_matched !== null && typeof data.content.user_name === 'string') {
                        DOM.homeBtnUserName.textContent = data.content.user_name;
                    } else {
                        DOM.homeBtnUserName.textContent = 'Home';
                    }

                    //SET ICON OR PHOTO IN HOME BTN
                    if (data.content.user_photo_url !== null &&  typeof data.content.user_photo_url === 'string') {
                        let full_photo_url = DOM.homeButton.dataset.url + data.content.user_photo_url
                        DOM.homeBtnUserPhoto.style.backgroundImage = `url("${full_photo_url}")`;
                    } else {
                        if (DOM.homeBtnUserName.textContent === 'Home' || user_name_matched === null) {
                            DOM.homeBtnUserPhoto.style.display = 'none';
                            DOM.homeBtnIcon.style.display = 'flex';
                        } else {
                            DOM.homeBtnUserPhoto.style.background = 'linear-gradient(93.94deg, #00F0FF 0.58%, #1DA5F1 98.1%)'
                            DOM.homeBtnUserPhoto.textContent = user_name_matched[0]
                        }
                    }
                }

            } else {
                console.log('Invalid login status response format');
                // Default to showing login button
                updateLoginUI(false);
            }
        },
        error: function(error) {
            clearTimeout(timeoutId);
            console.log("Error checking login status:", error);

            // Default to showing login button on error
            updateLoginUI(false);
        }
    });
}

function updateLoginUI(isLoggedIn) {
    // Prepare the correct button first, but keep it hidden
    if (isLoggedIn) {
        addClass(DOM.loginButton, 'hidden_btn');
        removeClass(DOM.homeButton, 'hidden_btn');
    } else {
        addClass(DOM.homeButton, 'hidden_btn');
        removeClass(DOM.loginButton, 'hidden_btn');
    }

    // Then hide the placeholder in a single animation frame to avoid flicker
    requestAnimationFrame(function() {
        if (DOM.placeholderButton) {
            addClass(DOM.placeholderButton, 'hidden_btn');
        }
    });
}

function handleScroll(lastScrollTop) {
    const scrollTop = window.scrollY;

    // Only update DOM if needed
    if (scrollTop < 800 && DOM.header.classList.contains('_hide')) {
        DOM.header.classList.remove('_hide');
    } else if (scrollTop >= 800) {
        if (scrollTop > lastScrollTop && !DOM.header.classList.contains('_hide')) {
            DOM.header.classList.add('_hide');
        } else if (scrollTop < lastScrollTop && DOM.header.classList.contains('_hide')) {
            DOM.header.classList.remove('_hide');
        }
    }
}
