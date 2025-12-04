import { showModal } from "./modal.js";
import { valid_token, alterPassword } from "./apis/users.js";

// Add Event Valid Token
document.addEventListener("DOMContentLoaded", async () => {
  const urlParams = new URLSearchParams(window.location.search);
  const token = urlParams.get("token");

  const res = await valid_token(token);

  if (res["status"] === "error") {
    showModal(res["status"], res["title"], res["message"]);

    setTimeout(() => {
      window.location.href = `${window.location.protocol}//${window.location.hostname}/projeto-ecogym/public/login.php`;

      return;
    }, 3000);
  }
});

// Function Alter Password
async function alter_password(e) {
  e.preventDefault();

  const form = e.target;

  const datas = Object.fromEntries(new FormData(form));

  if (datas["alter-password"].length < 8) {
    showModal(
      "error",
      "Senha Frágil!",
      "A senha precisa de no mínimo 8 caracteres."
    );
    return;
  }

  const urlParams = new URLSearchParams(window.location.search);
  const token = urlParams.get("token");

  const res = await alterPassword(datas, token);

  showModal(res["status"], res["title"], res["message"]);

  if (res["exit"]) {
    setTimeout(() => {
      window.location.href = `${window.location.protocol}//${window.location.hostname}/projeto-ecogym/public/login.php`;

      return;
    }, 3000);
  }
}

const form = document.querySelector("#alterPassword");
form.addEventListener("submit", alter_password);

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

// Function Compare Password
function comparePassword() {
  const password = document.querySelector("#alter-password");
  const passwordConfirm = document.querySelector("#alter-password-confirm");

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
