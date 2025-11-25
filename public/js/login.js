// Imports
import { insert, login } from "./apis/users.js";
import { showModal } from "./modal.js";
import { validateInput, validateSelect } from "./validFields.js";

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

// Change Form Animation
function changeForm() {
  const forms = document.querySelectorAll(".login-container");

  forms.forEach((form) => {
    form.classList.toggle("active-form");
  });
}

const btn_open_cadastro = document.querySelector(".open-cadastro-form");
const btn_open_login = document.querySelector(".open-login-form");

btn_open_cadastro.addEventListener("click", changeForm);
btn_open_login.addEventListener("click", changeForm);

// Reveal Password
function revealPassword(e) {
  const input = e.target.parentNode.parentNode.querySelector(".form-input");

  if (input.getAttribute("type") === "text") {
    input.setAttribute("type", "password");
    e.target.setAttribute("src", "./assets/vetores/visibility.svg");
  } else {
    input.setAttribute("type", "text");
    e.target.setAttribute("src", "./assets/vetores/visibility-off.svg");
  }
}

const btnRevealPassword = document.querySelectorAll(".reveal-password img");
btnRevealPassword.forEach((btnReveal) => {
  btnReveal.addEventListener("click", revealPassword);
});

// Function Select
function changeSelect(e) {
  if (e.target.selectedIndex) {
    e.target.style.color = "#dedede";
  } else {
    e.target.style.color = "#595959";
  }
}

const selects = document.querySelectorAll("select");
selects.forEach((select) => {
  select.addEventListener("change", changeSelect);
});

// Function Compare Password
function comparePassword() {
  const password = document.querySelector("#register-password");
  const passwordConfirm = document.querySelector("#register-password-confirm");

  const dataWarningPassword =
    password.parentNode.querySelector(".warning-data");

  const dataWarningCompare =
    passwordConfirm.parentNode.querySelector(".warning-data");

  if (password.value.length < 8) {
    password.classList.add("warning-field");

    dataWarningPassword.innerText = "Mínimo 8 caracteres";
    dataWarningPassword.style.display = "block";

    return;
  } else {
    password.classList.remove("warning-field");

    dataWarningPassword.innerText = "Preencha este campo";
    dataWarningPassword.style.display = "none";
  }

  if (passwordConfirm.value !== password.value) {
    passwordConfirm.classList.add("warning-field");

    dataWarningCompare.innerText = "As senhas divergem";
    dataWarningCompare.style.display = "block";
  } else {
    passwordConfirm.classList.remove("warning-field");

    dataWarningCompare.innerText = "Preencha este campo";
    dataWarningCompare.style.display = "none";
  }
}

const passwords = document.querySelectorAll(".compare-password");
passwords.forEach((password) => {
  password.addEventListener("input", comparePassword);
});

// Function Handle Submit
async function handleSubmit(e) {
  e.preventDefault();

  if (e.target.classList.contains("form-login")) {
    const datas = Object.fromEntries(new FormData(e.target));
    const res = await login(datas);

    if (res["status"] === "error") {
      showModal(res["status"], res["title"], res["message"]);
      e.target.querySelector("#user-password").value = "";
      return;
    }

    window.location.href = `http://localhost/projeto-ecogym/apis/files/start_session.php?id=${res["id"]}&name=${res["name"]}&email=${res["email"]}&permissao=${res["permissao"]}`;

    return;
  }

  let errorInput = validateInput(e.target);
  let errorSelect = validateSelect(e.target);

  if (errorInput || errorSelect) {
    showModal(
      "error",
      "Campos incorretos!",
      "Algum(ns) campo(s) do formulário não foram preenchido(s) corretamente."
    );
    return;
  }

  const datas = Object.fromEntries(new FormData(e.target));
  if (datas["register-password"].length < 8) {
    showModal(
      "error",
      "Senha Frágil!",
      "A senha precisa de no mínimo 8 caracteres."
    );
    return;
  }

  const res = await insert(datas);

  showModal(res["status"], res["title"], res["message"]);

  if (res["status"] === "success") {
    e.target.reset();
    changeForm();
  }
}

const forms = document.querySelectorAll("form");
forms.forEach((form) => {
  form.addEventListener("submit", handleSubmit);
});
