document.addEventListener("DOMContentLoaded", () => {
  const navButtons = document.querySelectorAll(".tag-button");
  const tutorials = document.querySelectorAll(".tutorial-article");
  
  let activeTag = "all"; // Default

  const updateList = () => {
    navButtons.forEach((btn) => {
      const tag = btn.getAttribute("data-tag");

      if (tag === activeTag) {
        btn.classList.add("active");
      } else {
        btn.classList.remove("active");
      }
    });

    tutorials.forEach((article) => {
      const articleTag = article.getAttribute("data-tag");

      if (activeTag === "all" || articleTag === activeTag) {
        article.style.display = "";
      } else {
        article.style.display = "none";
      }
    });
  };

  navButtons.forEach((button) => {
    button.addEventListener("click", () => {
      activeTag = button.getAttribute("data-tag");
      updateList();
    });
  });

  updateList(); // initial call
});
