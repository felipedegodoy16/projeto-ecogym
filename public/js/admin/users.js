import { loadingToggle } from "../loading.js";
import { insert, select, deleteUser, alter } from "../apis/users.js";
import { showModal } from "../modal.js";
import { formVisibility } from "./admin.js";
import { validateInput, validateSelect } from "../validFields.js";

// Function Handle Submit
async function handleSubmitUser(e) {
  e.preventDefault();

  const form = e.target;

  let errorInput = validateInput(form);
  let errorSelect = validateSelect(form);

  if (errorInput || errorSelect) {
    showModal(
      "error",
      "Campos incorretos!",
      "Algum(ns) campo(s) do formulário não foram preenchido(s) corretamente."
    );
    return;
  }

  const datas = Object.fromEntries(new FormData(form));
  const id = document.querySelector("#user-id").value;
  let res;

  if (id) {
    res = await alter(datas, id);
  } else {
    res = await insert(datas);
  }

  showModal(res["status"], res["title"], res["message"]);

  if (res["status"] === "success") {
    form.reset();

    if (id) {
      const ul = document.querySelector("#users-list");
      ul.innerHTML = "";

      waitResponseUsers();
      document.querySelector("#user-id").value = "";
    } else {
      addUsers(res["datas"]);
    }

    formVisibility(form);
  }
}

// Add Event All Forms
const form = document.querySelector("#cadastroForm");
form.addEventListener("submit", handleSubmitUser);

// Function Handle Delete
async function handleDeleteUser() {
  const card_focus_bg = document.querySelector("#cardFocusBg");
  closeCardFocus(card_focus_bg);

  const id_card_focus = card_focus_bg.querySelector("#id-card-focus");
  const id = id_card_focus.textContent.replace("#", "");

  const res = await deleteUser(id);

  showModal(res["status"], res["title"], res["message"]);

  if (res["status"] === "success") {
    const card_item = document.getElementById(`${id}`);
    card_item.remove();
  }
}

// Function Handle Edit
async function handleEditUser(datas) {
  const card_focus_bg = document.querySelector("#cardFocusBg");
  closeCardFocus(card_focus_bg);

  const form = document.querySelector("#cadastroForm");
  formVisibility(form);

  const input_id = document.querySelector("#user-id");
  const input_name = document.querySelector("#register-name");
  const input_cpf = document.querySelector("#register-cpf");
  const input_email = document.querySelector("#register-email");
  const input_phone = document.querySelector("#register-phone");
  const select_genre = document.querySelector("#register-genre");
  const input_password = document.querySelector("#register-password");
  const input_confirm_password = document.querySelector(
    "#register-password-confirm"
  );

  const input_cep = document.querySelector("#register-cep");
  const select_state = document.querySelector("#register-state");
  const input_city = document.querySelector("#register-city");
  const input_bairro = document.querySelector("#register-bairro");
  const input_street = document.querySelector("#register-street");
  const input_number = document.querySelector("#register-number");

  const genres = select_genre.querySelectorAll("option");
  const states = select_state.querySelectorAll("option");

  genres.forEach((op) => {
    if (op.value === datas["GENERO"]) {
      op.selected = true;
    }
  });

  states.forEach((op) => {
    if (op.value.toUpperCase() === datas["UF"]) {
      op.selected = true;
    }
  });

  input_id.value = datas["ID_USUARIO"];
  input_name.value = datas["NOME"];
  input_cpf.value = datas["CPF"];
  input_email.value = datas["EMAIL"];
  input_phone.value = datas["TELEFONE"];

  if (input_password.parentNode.style.display !== "none") {
    input_password.parentNode.style.display = "none";
    input_confirm_password.parentNode.style.display = "none";
  }

  input_cep.value = datas["CEP"];
  input_city.value = datas["CIDADE"];
  input_bairro.value = datas["BAIRRO"];
  input_street.value = datas["LOGRADOURO"];
  input_number.value = datas["NUMERO_RESIDENCIAL"];

  const btn_submit = form.querySelector(".btn-add-edit");
  btn_submit.innerText = "Alterar";
}

// Function Focus Card
function openFocusCard(datas) {
  let situation = "";
  let class_situation = "";

  if (datas["SITUACAO"] === "A") {
    class_situation = "card-active";
    situation = "Ativo";
  } else if (datas["SITUACAO"] === "I") {
    class_situation = "card-inactive";
    situation = "Inativo";
  } else if (datas["SITUACAO"] === "M") {
    class_situation = "card-maintenance";
    situation = "Novo";
  }

  const cpf_text = !!datas["CPF"] ? datas["CPF"] : "Não informado";
  const data_nasc_text = !!datas["DATA_NASCIMENTOF"]
    ? datas["DATA_NASCIMENTO"]
    : "Não informado";
  const phone_text = !!datas["TELEFONE"] ? datas["TELEFONE"] : "Não informado";

  const card_focus_bg = document.querySelector("#cardFocusBg");
  const card_focus = card_focus_bg.querySelector("#cardFocus");
  const id_card_focus = card_focus_bg.querySelector("#id-card-focus");
  const name_card_focus = card_focus_bg.querySelector("#name-user-card-focus");
  const cpf_card_focus = card_focus_bg.querySelector("#cpf-user-card-focus");
  const dataNasc_card_focus = card_focus_bg.querySelector(
    "#dataNasc-user-card-focus"
  );
  const phone_card_focus = card_focus_bg.querySelector(
    "#phone-user-card-focus"
  );
  const email_card_focus = card_focus_bg.querySelector(
    "#email-user-card-focus"
  );
  const situation_card_focus = card_focus_bg.querySelector(
    "#situation-user-card-focus"
  );
  const cep_card_focus = card_focus_bg.querySelector("#cep-user-card-focus");
  const state_card_focus = card_focus_bg.querySelector(
    "#state-user-card-focus"
  );
  const city_card_focus = card_focus_bg.querySelector("#city-user-card-focus");
  const bairro_card_focus = card_focus_bg.querySelector(
    "#bairro-user-card-focus"
  );
  const street_card_focus = card_focus_bg.querySelector(
    "#street-user-card-focus"
  );
  const number_card_focus = card_focus_bg.querySelector(
    "#number-user-card-focus"
  );

  card_focus_bg.classList.add("card-focus-bg-active");
  card_focus.classList.add(class_situation);
  name_card_focus.innerHTML = datas["NOME"];
  id_card_focus.innerHTML = `#${datas["ID_USUARIO"]}`;
  cpf_card_focus.innerHTML = `<span>CPF:</span> ${cpf_text}`;
  dataNasc_card_focus.innerHTML = `<span>Data Nasc.:</span> ${data_nasc_text}`;
  phone_card_focus.innerHTML = `<span>Telefone:</span> ${phone_text}`;
  email_card_focus.innerHTML = `<span>Email:</span> ${datas["EMAIL"]}`;
  cep_card_focus.innerHTML = `<span>CEP:</span> ${datas["CEP"]}`;
  state_card_focus.innerHTML = `<span>Estado:</span> ${datas["UF"]}`;
  city_card_focus.innerHTML = `<span>Cidade:</span> ${datas["CIDADE"]}`;
  bairro_card_focus.innerHTML = `<span>Bairro:</span> ${datas["BAIRRO"]}`;
  street_card_focus.innerHTML = `<span>Rua:</span> ${datas["LOGRADOURO"]}`;
  number_card_focus.innerHTML = `<span>Número:</span> ${datas["NUMERO_RESIDENCIAL"]}`;
  situation_card_focus.innerHTML = situation;

  card_focus_bg.addEventListener("click", function (e) {
    if (e.target === this) {
      closeCardFocus(card_focus_bg);
    }
  });

  const btn_edit_user = document.querySelector("#edit-user");
  btn_edit_user.addEventListener("click", () => {
    handleEditUser(datas);
  });
}

// Add Event Delete
const btn_delete_user = document.querySelector("#delete-user");
btn_delete_user.addEventListener("click", () => {
  if (confirm("Deseja realmente excluir esse usuário?")) {
    handleDeleteUser();
  }
});

// Add Event Btn Close
const btn_close_user = document.querySelector("#btn-close-user");
btn_close_user.addEventListener("click", () => {
  const input_password = document.querySelector("#register-password");
  const input_confirm_password = document.querySelector(
    "#register-password-confirm"
  );

  if (input_password.parentNode.style.display === "none") {
    input_password.parentNode.style.display = "block";
    input_confirm_password.parentNode.style.display = "block";
  }
});

// Fecha Card Focus
function closeCardFocus(card_focus_bg) {
  card_focus_bg.classList.remove("card-focus-bg-active");
  const card_focus = card_focus_bg.querySelector(".card-focus");
  card_focus.classList.remove("card-active");
  card_focus.classList.remove("card-inactive");
  card_focus.classList.remove("card-maintenance");

  const ul_address = document.querySelector("#address-informations-focus");
  ul_address.classList.toggle("oppen-card-address");
}

// Function Build Card User
function buildUser(datas) {
  const li = document.createElement("li");
  const div_header = document.createElement("div");
  const div_img = document.createElement("div");
  const h3 = document.createElement("h3");
  const span = document.createElement("span");

  li.className = "card-item card-user";
  div_header.className = "card-header";
  div_img.className = "card-img";
  h3.className = "card-name font-1-s";
  span.className = "card-cpf font-1-xs";

  if (datas["SITUACAO"] === "A") {
    li.classList.add("card-active");
  } else if (datas["SITUACAO"] === "I") {
    li.classList.add("card-inactive");
  } else if (datas["SITUACAO"] === "M") {
    li.classList.add("card-maintenance");
  }

  h3.innerHTML = `${datas["NOME"]}`;

  if (!datas["CPF"]) span.innerHTML = `Não Informado`;
  else span.innerHTML = `${datas["CPF"]}`;

  div_header.append(div_img, h3, span);

  li.id = datas["ID_USUARIO"];

  li.addEventListener("click", () => {
    openFocusCard(datas);
  });

  li.append(div_header);

  return li;
}

// Add Users
function addUsers(res) {
  const users_list = document.querySelector("#users-list");

  res.forEach((user) => {
    users_list.append(buildUser(user));
  });
}

// Function Wait Select Reponse
export async function waitResponseUsers() {
  const loadingContainer = document
    .querySelector(".body-section-active")
    .querySelector(".loading-container");

  const users_list = document.querySelector("#users-list");
  users_list.innerHTML = "";

  loadingToggle(loadingContainer);

  const res = await select();

  loadingToggle(loadingContainer);

  if (res) {
    addUsers(res);
    return;
  }
}
