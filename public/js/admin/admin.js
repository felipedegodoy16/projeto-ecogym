import { callRanking } from "./table.js";

// Function Alternate Visibility Form
export function formVisibility(form) {
  form.parentNode.classList.toggle("active-form-modal");
  form.style.display = "block";
  form.classList.toggle("form-visible");
  form.classList.toggle("form-hidden");

  if (form.classList.contains("form-hidden")) {
    form.reset();

    form.querySelector(".btn-add-edit").innerText = "Adicionar";
  }
}

const btns_visible_form = document.querySelectorAll(".btn-visible-form");
btns_visible_form.forEach((btn) => {
  btn.addEventListener("click", () => {
    const form = document
      .querySelector(".body-section-active")
      .querySelector(".form-visibility");
    formVisibility(form);
  });
});

// Adding Event to Page
document.addEventListener("DOMContentLoaded", () => {
  callRanking();
});
