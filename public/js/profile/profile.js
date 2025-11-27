import { alter_own, return_user } from "../apis/users.js";
import { showModal } from "../modal.js";
import { validateInput, validateSelect } from "../validFields.js";
import {
  callEnergyGenerated,
  callDoghnutChart,
  callRankingUsers,
  callRankingEquips,
  callGeneratedUserMonth,
  callBarChartUser,
} from "../utilitys/callInfos.js";

document.addEventListener("DOMContentLoaded", () => {
  callEnergyGenerated();
  callGeneratedUserMonth();
  setInterval(callEnergyGenerated, 100000);

  callBarChartUser();
  callDoghnutChart();
  callRankingUsers();
  callRankingEquips();
  callOwnDatas();
});

async function callOwnDatas() {
  let datas = await return_user();
  datas = datas[0];

  const user_name_photo = document.querySelector("#user-name-profile-photo");
  const user_cpf_photo = document.querySelector("#user-cpf-profile-photo");
  const user_email_photo = document.querySelector("#user-email-profile-photo");

  let cpf = datas["CPF"];

  if (!cpf) {
    cpf = "Não informado";
  }

  user_name_photo.innerHTML = datas["NOME"];
  user_cpf_photo.innerHTML = cpf;
  user_email_photo.innerHTML = datas["EMAIL"];

  const input_name = document.querySelector("#update-name");
  const input_cpf = document.querySelector("#update-cpf");
  const input_email = document.querySelector("#update-email");
  const input_phone = document.querySelector("#update-phone");
  const select_genre = document.querySelector("#update-genre");
  const input_nasc_date = document.querySelector("#update-nasc-date");

  const input_cep = document.querySelector("#update-cep");
  const select_state = document.querySelector("#update-state");
  const input_city = document.querySelector("#update-city");
  const input_bairro = document.querySelector("#update-bairro");
  const input_street = document.querySelector("#update-street");
  const input_number = document.querySelector("#update-number");

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

  const objectDate = new Date(datas["DATA_NASCIMENTO"] + "T00:00:00");

  const formattedDate = new Intl.DateTimeFormat("pt-BR", {
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
  }).format(objectDate);

  input_name.value = datas["NOME"];
  input_cpf.value = datas["CPF"];
  input_email.value = datas["EMAIL"];
  input_phone.value = datas["TELEFONE"];
  input_nasc_date.value = formattedDate;

  input_cep.value = datas["CEP"];
  input_city.value = datas["CIDADE"];
  input_bairro.value = datas["BAIRRO"];
  input_street.value = datas["LOGRADOURO"];
  input_number.value = datas["NUMERO_RESIDENCIAL"];
}

async function handleUpdateProfile(e) {
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

  const btn = form.querySelector(".btn-add-edit");
  btn.innerText = "Salvando...";

  const res = await alter_own(datas);

  btn.innerText = "Salvar alterações";

  showModal(res["status"], res["title"], res["message"]);

  if (res["status"] === "success") {
    const user_name_photo = document.querySelector("#user-name-profile-photo");
    const user_cpf_photo = document.querySelector("#user-cpf-profile-photo");
    const user_email_photo = document.querySelector(
      "#user-email-profile-photo"
    );

    let cpf = datas["update-cpf"];

    if (!cpf) {
      cpf = "Não informado";
    }

    user_name_photo.innerHTML = datas["update-name"];
    user_cpf_photo.innerHTML = cpf;
    user_email_photo.innerHTML = datas["update-email"];
  }
}

const form = document.querySelector("#updateProfileForm");
form.addEventListener("submit", handleUpdateProfile);
