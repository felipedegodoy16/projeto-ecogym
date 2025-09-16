// Smooth scrolling to sections
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    const headerHeight = document.querySelector('.header').offsetHeight;
    const elementPosition = element.offsetTop - headerHeight - 20;
    
    window.scrollTo({
        top: elementPosition,
        behavior: 'smooth'
    });
}

// Reveal sections on scroll
function revealOnScroll() {
    const sections = document.querySelectorAll('.content-section');
    
    sections.forEach(section => {
        const sectionTop = section.getBoundingClientRect().top;
        const sectionVisible = 200;
        
        if (sectionTop < window.innerHeight - sectionVisible) {
            section.classList.add('visible');
        }
    });
}

// Header background on scroll
function updateHeader() {
    const header = document.querySelector('.header');
    if (window.scrollY > 50) {
        header.style.background = 'rgba(0, 0, 0, 0.98)';
    } else {
        header.style.background = 'rgba(0, 0, 0, 0.95)';
    }
}

// Event listeners
window.addEventListener('scroll', () => {
    revealOnScroll();
    updateHeader();
});

// Initial reveal check
window.addEventListener('load', revealOnScroll);

// Navigation menu smooth scroll
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.nav-menu a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const elementPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: elementPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Optional: Add loading animation
document.addEventListener('DOMContentLoaded', function() {
    // Remove any loading class if you add one
    document.body.classList.add('loaded');
});

// Optional: Add intersection observer for better performance
if ('IntersectionObserver' in window) {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all content sections
    document.querySelectorAll('.content-section').forEach(section => {
        observer.observe(section);
    });
}