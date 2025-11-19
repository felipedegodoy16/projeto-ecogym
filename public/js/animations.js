// Functions for animations
const observerOptions = {
  threshold: 0.2,
  rootMargin: "0px 0px -20px 0px",
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (
      entry.isIntersecting &&
      !entry.target.classList.contains("fadeInOutActive")
    ) {
      entry.target.classList.add("fadeInOutActive");
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

document.addEventListener("DOMContentLoaded", function () {
  const animatedElements = document.querySelectorAll(
    ".fadeInOutRight, .fadeInOutLeft, .fadeInOutTop, .fadeInOutBottom"
  );
  animatedElements.forEach((el) => {
    observer.observe(el);
  });
});
