document.addEventListener("DOMContentLoaded", () => {
    const stepsDisabled = document.getElementById('article-page').classList.contains('no-steps');
    if (stepsDisabled) return;

    const stepsList = document.querySelector(".article-page__steps");
    let sectionIndex = 0;
    let stepIndex = 0;

    const firstH1 = document.querySelector(".article-page__content h1");
    if (firstH1) {
        sectionIndex++;
        const id = "section-" + sectionIndex;
        firstH1.setAttribute("id", id);
        stepsList.insertAdjacentHTML("beforeend", `
            <li class="article-page__step">
                <a href="#${id}" class="article-page__step-content">
                    <strong>Section ${sectionIndex}:</strong> Introduction
                </a>
            </li>
        `);
    }

    document.querySelectorAll(".article-page__content h2, .article-page__content h3").forEach(el => {
        const text = el.textContent.trim();
        let id;
        if (el.tagName.toLowerCase() === "h2") {
            sectionIndex++;
            stepIndex = 0;
            id = "section-" + sectionIndex;
            el.setAttribute("id", id);
            stepsList.insertAdjacentHTML("beforeend", `
                <li class="article-page__step">
                    <a href="#${id}" class="article-page__step-content">
                        <strong>Section ${sectionIndex}:</strong> ${text}
                    </a>
                </li>
            `);
        } else {
            stepIndex++;
            id = "step-" + sectionIndex + "-" + stepIndex;
            el.setAttribute("id", id);
            el.insertAdjacentHTML("afterbegin", `<span class="article-step-title__index">Step ${stepIndex}:</span>`);
            stepsList.insertAdjacentHTML("beforeend", `
                <li class="article-page__step article-page__step--small">
                    <a href="#${id}" class="article-page__step-content">
                        <strong>Step ${stepIndex}</strong>: ${text}
                    </a>
                </li>
            `);
        }
    });

    const navLinks = Array.from(document.querySelectorAll(".article-page__step-content"));

    function updateActiveLinks() {
        const viewportBottom = window.innerHeight;
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight;

        navLinks.forEach((link, index) => {
            const href = link.getAttribute("href");
            if (!href || !href.startsWith("#")) return;
            const section = document.querySelector(href);
            if (!section) return;

            const sectionRect = section.getBoundingClientRect();
            const hasScrolledPastOrReached = sectionRect.top < viewportBottom;
            const isLast = index === navLinks.length - 1;
            const nearBottom = scrollTop + window.innerHeight >= scrollHeight - 5;
            const stepItem = link.closest(".article-page__step");
            if (!stepItem) return;

            if (hasScrolledPastOrReached || (isLast && nearBottom)) {
                stepItem.classList.add("active");
            } else {
                stepItem.classList.remove("active");
            }
        });
    }

    navLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            const targetId = link.getAttribute("href");
            const targetEl = document.querySelector(targetId);
            if (!targetEl) return;
            e.preventDefault();
            window.scrollTo({
                top: targetEl.offsetTop - 20,
                behavior: "smooth"
            });
        });
    });

    window.addEventListener("scroll", updateActiveLinks);
    window.addEventListener("resize", updateActiveLinks);
    updateActiveLinks();
});