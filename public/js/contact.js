import { showModal } from "modal.js";

// Function handle submit
async function handleSubmit(e) {
  e.preventDefault();

  // Change button text temporarily
  const button = this.querySelector(".button");
  const originalText = button.textContent;
  button.textContent = "Enviando...";

  // showModal(res)
  // Simulate sending
  setTimeout(() => {
    button.textContent = "✅ Enviado!";

    // Reset form
    setTimeout(() => {
      this.reset();
      button.textContent = originalText;
    }, 2000);
  }, 1000);
}

// Form submission handler
document.getElementById("contactForm").addEventListener("submit", handleSubmit);
