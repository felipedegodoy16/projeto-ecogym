const observerOptions = {
    threshold: 0.2,
    rootMargin: '0px 0px -50px 0px',
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fadeInOutActive');
        }
    });
}, observerOptions);

document.addEventListener('DOMContentLoaded', function () {
    const animatedElements = document.querySelectorAll(
        '.fadeInOutRight, .fadeInOutLeft, .fadeInOutTop, .fadeInOutBottom'
    );
    animatedElements.forEach((el) => {
        observer.observe(el);
    });
});
