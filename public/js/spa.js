const mainContainer = document.querySelector('main');

function loadPage(url, addToHistory = true) {
    fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(res => {
            if (!res.ok) throw new Error('Page not found');
            return res.text();
        })
        .then(html => {
            // Parse the HTML string
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Get only the .main_container from the fetched page
            const newContent = doc.querySelector('main');

            if (newContent) {
                mainContainer.innerHTML = newContent.innerHTML;
            } else {
                mainContainer.innerHTML = '<p>Content not found</p>';
            }

            if (addToHistory && url !== location.href) {
                history.pushState(null, '', url);
            }
        })

        .catch(() => {
            mainContainer.innerHTML = '<p>Page not found</p>';
        });
}

// Intercept internal links
document.body.addEventListener('click', e => {
    if (e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey) return;

    const link = e.target.closest('a');
    if (!link) return;

    if (
        link.origin !== location.origin ||
        link.hasAttribute('download') ||
        link.getAttribute('href')?.startsWith('#')
    ) return;

    const linkUrl = new URL(link.getAttribute('href'), location.origin);

    // Compare path + search only, ignore hash
    const currentPath = location.pathname + location.search;
    const linkPath = linkUrl.pathname + linkUrl.search;

    if (linkPath === currentPath) return; // ignore same page links

    e.preventDefault();
    loadPage(linkUrl.href);
});


// Handle browser back/forward buttons
window.addEventListener('popstate', () => {
    loadPage(location.href, false);
});

window.loadPage = loadPage;
