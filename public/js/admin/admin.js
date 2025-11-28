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
  const active_address = document.querySelector("#li-address-informations");
  const ul_address = document.querySelector("#address-informations-focus");
  active_address.addEventListener("click", () => {
    ul_address.classList.toggle("oppen-card-address");
  });

  const btn_css_theme = document.querySelector(".btn-css-theme");
  btn_css_theme.addEventListener("click", alter_theme);
});

function alter_theme(e) {
  let element = e.target;
  if (element.tagName.toUpperCase() === "SVG") {
    element = element.parentNode;
  } else if (element.tagName.toUpperCase() === "PATH") {
    element = element.parentNode.parentNode;
  }

  const css_theme = document.querySelector("#css-theme");
  if (css_theme.getAttribute("href") === "./css/style.css") {
    css_theme.setAttribute("href", "./css/style-light.css");
    element.innerHTML =
      "<svg class='theme-icon-moon' xmlns='http://www.w3.org/2000/svg' height='40px' viewBox='0 -960 960 960' width='40px' fill='#39b934'><path d='M480-120q-151 0-255.5-104.5T120-480q0-138 90-239.5T440-838q13-2 23 3.5t16 14.5q6 9 6.5 21t-7.5 23q-17 26-25.5 55t-8.5 61q0 90 63 153t153 63q31 0 61.5-9t54.5-25q11-7 22.5-6.5T819-479q10 5 15.5 15t3.5 24q-14 138-117.5 229T480-120Zm0-80q88 0 158-48.5T740-375q-20 5-40 8t-40 3q-123 0-209.5-86.5T364-660q0-20 3-40t8-40q-78 32-126.5 102T200-480q0 116 82 198t198 82Zm-10-270Z' /></svg>";
  } else {
    css_theme.setAttribute("href", "./css/style.css");
    element.innerHTML =
      "<svg xmlns='http://www.w3.org/2000/svg' height='40px' viewBox='0 -960 960 960' width='40px' fill='#39b934'><path d='M480-760q-17 0-28.5-11.5T440-800v-80q0-17 11.5-28.5T480-920q17 0 28.5 11.5T520-880v80q0 17-11.5 28.5T480-760Zm198 82q-11-11-11-27.5t11-28.5l56-57q12-12 28.5-12t28.5 12q11 11 11 28t-11 28l-57 57q-11 11-28 11t-28-11Zm122 238q-17 0-28.5-11.5T760-480q0-17 11.5-28.5T800-520h80q17 0 28.5 11.5T920-480q0 17-11.5 28.5T880-440h-80ZM480-40q-17 0-28.5-11.5T440-80v-80q0-17 11.5-28.5T480-200q17 0 28.5 11.5T520-160v80q0 17-11.5 28.5T480-40ZM226-678l-57-56q-12-12-12-29t12-28q11-11 28-11t28 11l57 57q11 11 11 28t-11 28q-12 11-28 11t-28-11Zm508 509-56-57q-11-12-11-28.5t11-27.5q11-11 27.5-11t28.5 11l57 56q12 11 11.5 28T791-169q-12 12-29 12t-28-12ZM80-440q-17 0-28.5-11.5T40-480q0-17 11.5-28.5T80-520h80q17 0 28.5 11.5T200-480q0 17-11.5 28.5T160-440H80Zm89 271q-11-11-11-28t11-28l57-57q11-11 27.5-11t28.5 11q12 12 12 28.5T282-225l-56 56q-12 12-29 12t-28-12Zm311-71q-100 0-170-70t-70-170q0-100 70-170t170-70q100 0 170 70t70 170q0 100-70 170t-170 70Zm0-80q66 0 113-47t47-113q0-66-47-113t-113-47q-66 0-113 47t-47 113q0 66 47 113t113 47Zm0-160Z' /></svg>";
  }
}

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
