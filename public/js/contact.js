import { send_message } from "./apis/users.js";
import { showModal } from "./modal.js";
import { validateInput } from "./validFields.js";

// Function handle submit
async function handleSubmit(e) {
  e.preventDefault();

  const form = e.target;

  let errorInput = validateInput(form);

  if (errorInput) {
    showModal(
      "error",
      "Campos incorretos!",
      "Algum(ns) campo(s) do formulário não foram preenchido(s) corretamente."
    );
    return;
  }

  // Change button text temporarily
  const button = this.querySelector(".button");
  const originalText = button.textContent;
  button.textContent = "Enviando...";

  const datas = Object.fromEntries(new FormData(form));
  const res = await send_message(datas);

  button.textContent = originalText;

  showModal(res["status"], res["title"], res["message"]);

  if (res["status"] === "success") {
    form.reset();
  }
}

// Form submission handler
document.getElementById("contactForm").addEventListener("submit", handleSubmit);
