// Imports
import { recover_password } from "./apis/users.js";
import { showModal } from "./modal.js";

// Animated Energy Particles
function createEnergyParticles() {
  const energyBg = document.getElementById("energyBg");

  for (let i = 0; i < 15; i++) {
    const particle = document.createElement("div");
    particle.className = "energy-particle";
    particle.style.left = Math.random() * 100 + "%";
    particle.style.animationDelay = Math.random() * 8 + "s";
    energyBg.appendChild(particle);
  }
}

// Initialize animations
document.addEventListener("DOMContentLoaded", function () {
  createEnergyParticles();
});

// Function Handle Submit
async function handleSubmit(e) {
  e.preventDefault();

  const form = e.target;

  const email = form.querySelector("#email-recover").value;

  if (!email) {
    showModal("error", "Email incorreto!", "O email precisa ser preenchido");
    return;
  }

  const btn_action = form.querySelector("button");
  btn_action.textContent = "Enviando...";

  const res = await recover_password(email);

  showModal(res["status"], res["title"], res["message"]);

  btn_action.textContent = "Recuperar senha";

  if (res["status"] === "success") {
    form.reset();

    setTimeout(() => {
      window.location.href = `${window.location.protocol}//${window.location.hostname}/projeto-ecogym/public/login.php`;

      return;
    }, 3000);
  }
}

const form = document.querySelector("form");
form.addEventListener("submit", handleSubmit);
