document.addEventListener('DOMContentLoaded', () => {

	const contentContainer = document.querySelector('.js-feature-container');
	const allowedPages = window.allowedPages || [];
	let currentPage = window.currentPage || allowedPages[0] || '';
	let isLoading = false;

	const animatedScrollTo = (element, offset = 40, duration = 700) => {
		if (!element) return;
		const elementPosition = element.getBoundingClientRect().top;
		const startPosition = window.pageYOffset;
		const targetPosition = elementPosition + startPosition - offset;
		let startTime = null;
		const easeInOutQuad = (t, b, c, d) => {
			t /= d / 2;
			if (t < 1) return c / 2 * t * t + b;
			t--;
			return -c / 2 * (t * (t - 2) - 1) + b;
		};
		const animation = (currentTime) => {
			if (startTime === null) startTime = currentTime;
			const timeElapsed = currentTime - startTime;
			const run = easeInOutQuad(timeElapsed, startPosition, targetPosition - startPosition, duration);
			window.scrollTo(0, run);
			if (timeElapsed < duration) {
				requestAnimationFrame(animation);
			}
		};
		requestAnimationFrame(animation);
	};

	const createArticle = (html, pageName, prepend = false) => {
		const article = document.createElement('article');
		article.id = pageName;
		article.className = 'feature-article';
		article.innerHTML = html;
		prepend ? contentContainer.prepend(article) : contentContainer.appendChild(article);
		return article;
	};

	const loadPage = async (pageName, scroll = true, prepend = false) => {
		if (isLoading || !allowedPages.includes(pageName) || document.getElementById(pageName)) {
			return null;
		}
		isLoading = true;
		try {
			const response = await fetch(`feature.php?page=${pageName}&json=true`);
			if (!response.ok) throw new Error(response.status);
			const data = await response.json();
			if (data.error) throw new Error(data.error);

			const article = createArticle(data.html, data.pageName, prepend);

			// let imagePromises = [];
			// if (scroll) {
			// 	const images = article.querySelectorAll('img');
			// 	imagePromises = Array.from(images).map(img => new Promise(resolve => {
			// 		if (img.complete) {
			// 			resolve();
			// 		} else {
			// 			img.addEventListener('load', resolve, { once: true });
			// 			img.addEventListener('error', resolve, { once: true });
			// 		}
			// 	}));
			// }

			if (scroll) {
				// const images = article.querySelectorAll('img');
				// const promises = Array.from(images).map(img => new Promise(resolve => {
				// 	if (img.complete) resolve();
				// 	else {
				// 		img.addEventListener('load', resolve, { once: true });
				// 		img.addEventListener('error', resolve, { once: true });
				// 	}
				// }));
				// await Promise.all(promises);
				animatedScrollTo(article);
			}

			if (!prepend) observeLastArticle();
			observeVisibleArticles();
			initNavigationEvents();
			return article;
			// return { article, imagePromises };
		} catch (error) {
			console.error('Error loading page:', error);
			alert(error.message === '404' ? 'Page not found.' : 'An error occurred.');
			return null;
		} finally {
			isLoading = false;
		}
	};

	const loadObserver = new IntersectionObserver((entries) => {
		if (entries[0].isIntersecting && !isLoading && allowedPages.length) {
			const currentIndex = allowedPages.indexOf(currentPage);
			if (currentIndex < allowedPages.length - 1) {
				loadPage(allowedPages[currentIndex + 1], false, false);
			}
		}
	}, { rootMargin: '0px 0px -55% 0px' });

	const observeLastArticle = () => {
		const lastArticle = contentContainer.querySelector('article.feature-article:last-child');
		loadObserver.disconnect();
		if (lastArticle) loadObserver.observe(lastArticle);
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
			if (allowedPages.includes(pageName)) {
				setCurrentPage(pageName);
			}
		}
	}, { rootMargin: '0px', threshold: Array.from({ length: 101 }, (_, i) => i / 100) });

	const observeVisibleArticles = () => {
		const articles = contentContainer.querySelectorAll('article');
		visibilityObserver.disconnect();
		articles.forEach(article => visibilityObserver.observe(article));
	};

	const setCurrentPage = (pageName, updateHistory = true) => {
		if (!pageName || currentPage === pageName) return;
		currentPage = pageName;
		if (updateHistory) {
			history.pushState({ page: pageName }, '', `feature.php?page=${pageName}`);
		}
		// updateNavigation(pageName);
		// updatePrevNextButtons();
	};

	const handleNavigation = async (e) => {
		e.preventDefault();

		const targetElement = e.target.closest('[data-page]');
		if (!targetElement) return;

		const targetPage = targetElement.dataset.page;
		if (!targetPage || !allowedPages.includes(targetPage) || targetElement.classList.contains('disabled')) return;

		const existingArticle = document.getElementById(targetPage);

		if (existingArticle) {
			animatedScrollTo(existingArticle);
			// setCurrentPage(targetPage);
		} else {
			const allImagePromises = [];
			let targetArticleElement = null;

			const currentIndex = allowedPages.indexOf(currentPage);
			const targetIndex = allowedPages.indexOf(targetPage);
			if (targetIndex < currentIndex) {
				for (let i = currentIndex - 1; i >= targetIndex; i--) {
					await loadPage(allowedPages[i], i === targetIndex, true);
					// const result = await loadPage(allowedPages[i], true, true);
					// if (result) {
					// 	allImagePromises.push(...result.imagePromises);
					// 	if (i === targetIndex) {
					// 		targetArticleElement = result.article;
					// 	}
					// }
				}
			} else {
				for (let i = currentIndex + 1; i <= targetIndex; i++) {
					await loadPage(allowedPages[i], i === targetIndex, false);
					// const result = await loadPage(allowedPages[i], true, false);
					// if (result) {
					// 	allImagePromises.push(...result.imagePromises);
					// 	if (i === targetIndex) {
					// 		targetArticleElement = result.article;
					// 	}
					// }
				}
			}
			// await Promise.all(allImagePromises);
			// if (targetArticleElement) {
			// 	animatedScrollTo(targetArticleElement);
			// }

			// setCurrentPage(targetPage);
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
		// updatePrevNextButtons();
		initNavigationEvents();
	}

	window.addEventListener('popstate', (e) => {
		if (e.state?.page && allowedPages.includes(e.state.page)) {
			const article = document.getElementById(e.state.page);
			if (article) {
				animatedScrollTo(article);
			}
			setCurrentPage(e.state.page, false);
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
			if (!isActive) header.classList.add('active');
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

	return;

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

});