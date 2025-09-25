// Animated Energy Particles
function createEnergyParticles() {
    const energyBg = document.getElementById('energyBg');

    for (let i = 0; i < 15; i++) {
        const particle = document.createElement('div');
        particle.className = 'energy-particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 8 + 's';
        energyBg.appendChild(particle);
    }
}

// Form Validation and Animation
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (email && password) {
        const button = document.querySelector('.btn-primary');
        const originalText = button.textContent;

        button.textContent = 'Gerando Energia...';
        button.style.background = 'var(--cor-p3)';

        setTimeout(() => {
            button.textContent = '⚡ Logado com Sucesso!';
            button.style.background = 'var(--cor-p1)';

            setTimeout(() => {
                alert(
                    'Login realizado com sucesso!\n\nEnergia gerada: +0.25 kWh\nBem-vindo ao EcoGym!'
                );
                button.textContent = originalText;
                button.style.background = 'var(--cor-p2)';
            }, 1500);
        }, 1000);
    }
});

// Initialize animations
document.addEventListener('DOMContentLoaded', function () {
    createEnergyParticles();
});
