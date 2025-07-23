document.addEventListener('DOMContentLoaded', () => {
	const contentContainer = document.querySelector('.js-feature-container');
	const allowedPages = window.allowedPages || [];
	let currentPage = window.currentPage || allowedPages[0] || '';
	let isLoading = false;

	const createArticle = (html, pageName, prepend = false) => {
		const article = document.createElement('article');
		article.id = pageName;
		article.className = 'feature-article';
		article.innerHTML = html;
		prepend ? contentContainer.prepend(article) : contentContainer.appendChild(article);
		return article;
	};

	const loadPage = async (pageName, scroll = true, prepend = false) => {
		if (
			isLoading ||
			typeof pageName !== 'string' ||
			!pageName.trim() ||
			!Array.isArray(allowedPages) ||
			!allowedPages.includes(pageName) ||
			document.getElementById(pageName)
		) return;
		isLoading = true;

		try {
			const response = await fetch(`feature.php?page=${pageName}&json=true`);
			if (!response.ok) throw new Error(response.status);
			const data = await response.json();
			if (data.error) throw new Error(data.error);

			const article = createArticle(data.html, data.pageName, prepend);

			if (!prepend) observeLastArticle();
			observeVisibleArticles();
			initNavigationEvents();
			// if (scroll) article.scrollIntoView({ behavior: 'smooth' });
			if (scroll) {
				const images = article.querySelectorAll('img');
				const promises = [];

				images.forEach(img => {
					const promise = new Promise((resolve, reject) => {
						if (img.complete) {
							resolve();
						} else {
							img.addEventListener('load', resolve, { once: true });
							img.addEventListener('error', resolve, { once: true });
						}
					});
					promises.push(promise);
				});

				await Promise.all(promises);

				article.scrollIntoView({ behavior: 'smooth' });
			}
		} catch (error) {
			console.error('Error loading page:', error);
			alert(error.message === '404' ? 'Page not found.' : 'An error occurred.');
		} finally {
			isLoading = false;
		}
	};

	const updateNavigation = (activePage) => {
		document.querySelectorAll('.js-feature-nav').forEach(link => {
			link.classList.toggle('active', link.dataset.page === activePage);
		});
	};

	const updatePrevNextButtons = () => {
		if (!allowedPages.length) return;
		const currentIndex = allowedPages.indexOf(currentPage);
		document.querySelectorAll('.js-feature-prev').forEach(button => {
			button.classList.toggle('disabled', currentIndex === 0);
			button.dataset.page = currentIndex > 0 ? allowedPages[currentIndex - 1] : '';
		});
		document.querySelectorAll('.js-feature-next').forEach(button => {
			button.classList.toggle('disabled', currentIndex === allowedPages.length - 1);
			button.dataset.page = currentIndex < allowedPages.length - 1 ? allowedPages[currentIndex + 1] : '';
		});
	};

	const loadObserver = new IntersectionObserver((entries) => {
		if (entries[0].isIntersecting && !isLoading && allowedPages.length) {
			const currentIndex = allowedPages.indexOf(currentPage);
			if (currentIndex < allowedPages.length - 1) {
				loadPage(allowedPages[currentIndex + 1], false, false);
			}
		}
	}, {
		rootMargin: '0px 0px -55% 0px'
	});

	const observeLastArticle = () => {
		const article = contentContainer.querySelector('article:last-child');
		visibilityObserver.disconnect();
		if (article) loadObserver.observe(article);
	};

	const visibilityObserver = new IntersectionObserver((entries) => {
		let maxViewportRatio = 0;
		let mostVisibleEntry = null;

		entries.forEach(entry => {
			if (entry.isIntersecting) {
				const visibleHeight = Math.min(entry.boundingClientRect.bottom, window.innerHeight) - Math.max(entry.boundingClientRect.top, 0);
				const viewportRatio = visibleHeight / window.innerHeight;

				if (viewportRatio > maxViewportRatio) {
					maxViewportRatio = viewportRatio;
					mostVisibleEntry = entry;
				}
			}
		});

		if (mostVisibleEntry && maxViewportRatio > 0.5) {
			const pageName = mostVisibleEntry.target.id;
			if (pageName !== currentPage && allowedPages.includes(pageName)) {
				currentPage = pageName;
				history.pushState({ page: pageName }, '', `feature.php?page=${pageName}`);
				updateNavigation(pageName);
				updatePrevNextButtons();
			}
		}
	}, {
		rootMargin: '0px',
		threshold: Array.from({ length: 101 }, (_, i) => i / 100)
	});

	const observeVisibleArticles = () => {
		const articles = contentContainer.querySelectorAll('article');
		visibilityObserver.disconnect();
		articles.forEach(article => visibilityObserver.observe(article));
	};

	const handleNavigation = async (e) => {
		e.preventDefault();
		const targetPage = e.target.dataset.page;
		if (!allowedPages.includes(targetPage) || e.target.classList.contains('disabled')) return;

		const currentIndex = allowedPages.indexOf(currentPage);
		const targetIndex = allowedPages.indexOf(targetPage);
		const existingArticle = document.getElementById(targetPage);

		if (existingArticle) {
			existingArticle.scrollIntoView({ behavior: 'smooth' });
			currentPage = targetPage;
		} else if (targetIndex < currentIndex) {
			for (let i = currentIndex - 1; i >= targetIndex; i--) {
				await loadPage(allowedPages[i], i === targetIndex, true);
			}
		} else {
			for (let i = currentIndex + 1; i <= targetIndex; i++) {
				await loadPage(allowedPages[i], i === targetIndex, false);
			}
		}
	};

	const initNavigationEvents = () => {
		document.querySelectorAll('.js-feature-nav[data-page], .js-feature-prev, .js-feature-next').forEach(link => {
			link.removeEventListener('click', handleNavigation);
			link.addEventListener('click', handleNavigation);
		});
	};

	if (allowedPages.length) {
		observeLastArticle();
		observeVisibleArticles();
		updatePrevNextButtons();
		initNavigationEvents();
	}

	window.addEventListener('popstate', (e) => {
		if (e.state?.page && allowedPages.includes(e.state.page)) {
			currentPage = e.state.page;
			updateNavigation(currentPage);
			const article = document.getElementById(currentPage);
			if (article) article.scrollIntoView({ behavior: 'smooth' });
			updatePrevNextButtons();
		}
	});


	document.addEventListener('click', function (event) {
		const target = event.target;
		const header = target.closest('.js-feature-header');
		const currentNav = target.closest('.js-current-nav');
		const featureNav = target.closest('.feature-nav');

		const activeHeaders = document.querySelectorAll('.js-feature-header.active');

		if (currentNav && header) {
			event.preventDefault();

			const isActive = header.classList.contains('active');

			activeHeaders.forEach(el => el.classList.remove('active'));

			if (!isActive) {
				header.classList.add('active');
			}
			return;
		}

		if (featureNav && header) {
			header.classList.remove('active');
			return;
		}

		activeHeaders.forEach(el => el.classList.remove('active'));
	});

	window.addEventListener('resize', function () {
		document.querySelectorAll('.js-feature-header.active').forEach(el => {
			el.classList.remove('active');
		});
	});
});