document.addEventListener("DOMContentLoaded", function () {
  setupFaqAccordion();
});

// FAQ accordion functionality
function setupFaqAccordion(root = document) {
  const questions = root.querySelectorAll(".faq-question");

  questions.forEach((question) => {
    // Prevent duplicate bindings
    if (question.dataset.bound === "true") return;
    question.dataset.bound = "true";

    question.addEventListener("click", function () {
      const faqItem = this.closest(".faq-item");
      if (faqItem) {
        faqItem.classList.toggle("active");
      }
    });
  });
}
