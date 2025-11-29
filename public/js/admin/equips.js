import { loadingToggle } from "../loading.js";
import { insert, select, deleteEquip, alter } from "../apis/equipments.js";
import { showModal } from "../modal.js";
import { formVisibility } from "./admin.js";
import { validateInput } from "../validFields.js";

// Function Handle Submit
async function handleSubmitEquip(e) {
  e.preventDefault();

  const form = e.target;

  let errorInput = validateInput(form);

  if (errorInput) {
    return;
  }

  const datas = Object.fromEntries(new FormData(form));
  const id = document.querySelector("#equip-id").value;
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
      const ul = document.querySelector("#equips-list");
      ul.innerHTML = "";

      waitResponseEquips();
      document.querySelector("#equip-id").value = "";
    } else {
      addEquips(res["datas"]);
    }

    formVisibility(form);
  }
}

// Add Event All Forms
const form = document.querySelector("#cadastroEquips");
form.addEventListener("submit", handleSubmitEquip);

// Function Build Card Equip
function buildEquip(datas, cont) {
  const li = document.createElement("li");
  const a_edit = document.createElement("a");
  const a_delete = document.createElement("a");
  const div = document.createElement("div");
  const ul = document.createElement("ul");
  const li_item_name = document.createElement("li");
  const li_item_kcal = document.createElement("li");
  const li_item_situation = document.createElement("li");
  const li_item_acions = document.createElement("li");

  li.className = "card-item card-equip";
  a_edit.classList.add("card-actions");
  a_delete.classList.add("card-actions");
  div.classList.add("card-img");
  div.style.backgroundImage =
    "url('./assets/equipments/equips/equips_default.png')";
  ul.classList.add("card-body");
  li_item_name.className = "font-2-xs cor-4";
  li_item_kcal.className = "font-2-xs cor-4";
  li_item_situation.className = "font-2-xs cor-4 card-situation";
  li_item_acions.className = "font-2-xs cor-4";

  let situation = "";

  if (datas["SITUACAO"] === "A") {
    li.classList.add("card-active");
    situation = "Ativo";
  } else if (datas["SITUACAO"] === "I") {
    li.classList.add("card-inactive");
    situation = "Inativo";
  } else if (datas["SITUACAO"] === "M") {
    li.classList.add("card-maintenance");
    situation = "Manutenção";
  }

  li_item_name.innerHTML = `<span>Nome:</span> ${datas["NOME"]}`;
  li_item_kcal.innerHTML = `<span>Kcal/h:</span> ${datas["KCAL_HORA"]}`;
  li_item_situation.innerHTML = `<span class="card-tag">${situation}</span>`;
  li_item_acions.innerHTML = `<span>Ações:</span> `;

  a_edit.innerText = "Editar";
  a_edit.addEventListener("click", (e) => {
    const ul = e.target.parentNode.parentNode;
    const li_list = ul.querySelectorAll("li");

    const form = document.querySelector(".form-equips-item");

    const inputId = form.querySelector("#equip-id");
    const inputName = form.querySelector("#equip-name");
    const inputKcal = form.querySelector("#equip-kcal");
    const inputRadios = form.querySelectorAll("input[type=radio]");

    let name = li_list[0].innerText.split(":")[1];
    let kcal = li_list[1].innerText.split(":")[1];
    let situation = li_list[2].innerText;

    if (situation.toUpperCase() === "ATIVO") situation = "ACTIVE";
    else if (situation.toUpperCase() === "INATIVO") situation = "INACTIVE";
    else if (situation.toUpperCase() === "MANUTENÇÃO")
      situation = "MAINTENANCE";

    inputId.value = datas["ID_EQUIPAMENTO"];
    inputName.value = name;
    inputKcal.value = kcal;
    inputRadios.forEach((input) => {
      if (input.id.toUpperCase() === situation.toUpperCase().trim()) {
        input.checked = true;
      }
    });

    const button = form.querySelector(".btn-add-edit");
    button.innerText = "Alterar";
    formVisibility(form);
  });

  a_delete.innerText = "Excluir";
  a_delete.addEventListener("click", async (e) => {
    if (!confirm("Tem certeza que deseja excluir este item?")) {
      return;
    }

    const res = await deleteEquip(datas["ID_EQUIPAMENTO"]);
    showModal(res["status"], res["title"], res["message"]);

    if (res["status"] === "success")
      e.target.parentNode.parentNode.parentNode.remove();
  });

  li_item_acions.append(a_edit, a_delete);

  ul.append(li_item_name, li_item_kcal, li_item_situation, li_item_acions);

  li.append(div, ul);

  li.style.animation = `fadeInUp ${cont}s ease`;

  return li;
}

// Add Equips
function addEquips(res) {
  const equips_list = document.querySelector("#equips-list");

  let cont = 1;

  res.forEach((equip) => {
    equips_list.append(buildEquip(equip, cont * 0.2));
    cont++;
  });
}

// Function Wait Select Reponse
export async function waitResponseEquips() {
  const loadingContainer = document
    .querySelector(".body-section-active")
    .querySelector(".loading-container");

  const equips_list = document.querySelector("#equips-list");
  equips_list.innerHTML = "";

  loadingToggle(loadingContainer);

  const res = await select();

  loadingToggle(loadingContainer);

  if (res) {
    addEquips(res);
    return;
  }
}
