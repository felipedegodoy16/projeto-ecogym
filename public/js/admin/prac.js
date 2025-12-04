import { loadingToggle } from "../loading.js";
import {
  insert,
  select,
  deletePrac,
  select_prac_user,
  select_prac,
  alter,
} from "../apis/prac.js";
import { showModal } from "../modal.js";
import { formVisibility } from "./admin.js";
import { validateInput, validateSelect } from "../validFields.js";

document
  .getElementById("cadastroPrac")
  .addEventListener("submit", async function (e) {
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

    // Captura os dados do treino
    const prac_id = document.querySelector("#prac-id").value;
    const prac_name = document.querySelector("#prac-name").value;
    const prac_relax = document.querySelector("#prac-relax").value;

    // Captura exercícios
    const div_exercises = document.querySelectorAll(".div-form-exercise");
    const exercises = [];

    div_exercises.forEach((box) => {
      exercises.push({
        id: box.querySelector('input[name="id-exer"]').value,
        name: box.querySelector('input[name="exer-name"]').value,
        series: box.querySelector('input[name="exer-series"]').value,
        reps: box.querySelector('input[name="exer-reps"]').value,
        charge: box.querySelector('input[name="exer-charge"]').value,
      });
    });

    // Monta o JSON final
    const datas = {
      practice: {
        id: prac_id,
        name: prac_name,
        relax: prac_relax,
      },
      exercises: exercises,
    };

    let res;

    if (prac_id) {
      res = await alter(datas, prac_id);
    } else {
      if (window.location.href.includes("profile.php")) {
        res = await insert(datas, "user");
      } else {
        res = await insert(datas);
      }
    }

    showModal(res["status"], res["title"], res["message"]);

    if (res["status"] === "success") {
      form.reset();

      if (prac_id) {
        const ul = document.querySelector("#prac-list");
        ul.innerHTML = "";

        if (window.location.href.includes("profile.php"))
          waitResponsePracsUser();
        else waitResponsePracs();

        document.querySelector("#prac-id").value = "";
      } else {
        addPracs(res["datas"]);
      }

      formVisibility(form);

      const exer_list = document.querySelector(".exer-list");
      exer_list.innerHTML = "";
    }
  });

// Function Handle Delete
async function handleDeletePrac() {
  const card_focus_bg = document.querySelector("#cardPracFocusBg");
  closeCardFocus(card_focus_bg);

  const name_card_focus = card_focus_bg.querySelector("#name-prac-card-focus");
  const firstSpace = name_card_focus.textContent.indexOf(" ");
  const id = name_card_focus.textContent.slice(0, firstSpace).replace("#", "");

  const res = await deletePrac(id);

  showModal(res["status"], res["title"], res["message"]);

  if (res["status"] === "success") {
    const card_item = document.getElementById(`${id}`);
    card_item.remove();
  }
}

// Function Handle Edit
async function handleEditPrac() {
  const card_focus_bg = document.querySelector("#cardPracFocusBg");
  const titlePrac = card_focus_bg.querySelector(
    "#name-prac-card-focus"
  ).textContent;
  const indexSpace = titlePrac.indexOf(" ");

  const id_treino = titlePrac.slice(1, indexSpace);

  let datas = await select_prac(id_treino);
  datas = datas[0];

  closeCardFocus(card_focus_bg);

  const form = document.querySelector("#cadastroPrac");
  formVisibility(form);

  const input_id = document.querySelector("#prac-id");
  const input_name = document.querySelector("#prac-name");
  const select_relax = document.querySelector("#prac-relax");

  const relax = select_relax.querySelectorAll("option");

  relax.forEach((op) => {
    if (op.value == datas["relax"]) {
      op.selected = true;
    }
  });

  input_id.value = datas["id_treino"];
  input_name.value = datas["name_treino"];

  if (datas["exercises"]) {
    datas["exercises"].forEach((e) => {
      addExercise(e);
    });
  }

  const btn_submit = form.querySelector(".btn-add-edit");
  btn_submit.innerText = "Alterar";
}

// Function Remove Exer
function removeExer(id) {
  document.getElementById("exer_" + id).remove();
}

let cont = 0;

// Function Add Exer
function addExercise(e) {
  cont++;

  const div = document.createElement("div");
  div.classList.add("div-form-exercise");
  div.setAttribute("id", "exer_" + cont);

  div.innerHTML = `
    <input type="hidden" value="${e["id_exercise"]}" name="id-exer">
    <div class="form-group">
      <label class="form-label" for="exer-name">Exercício</label>
      <input type="text" class="form-input" value="${e["name_exercise"]}" name="exer-name" placeholder="Exercício">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="form-group">
      <label class="form-label" for="exer-series">Séries</label>
      <input type="text" class="form-input" value="${e["series"]}" name="exer-series" data-mask="00" placeholder="00">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="form-group">
      <label class="form-label" for="exer-reps">Repetições</label>
      <input type="text" class="form-input" value="${e["reps"]}" name="exer-reps" data-mask="00" placeholder="00">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="form-group">
      <label class="form-label" for="exer-charge">Carga (kg)</label>
      <input type="text" class="form-input" value="${e["charge"]}" name="exer-charge" data-mask="00" placeholder="00">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="btn-remove-exer-form">
      <button type="button" class="button btn-close" onclick="removeExer(${cont})">Remover Exercício</button>
    </div>
  `;

  document.querySelector(".exer-list").appendChild(div);
}

// Function Focus Card
function openFocusCard(datas) {
  const card_focus_bg = document.querySelector("#cardPracFocusBg");

  const name_card_focus = card_focus_bg.querySelector("#name-prac-card-focus");
  const relax_card_focus = card_focus_bg.querySelector("#relax-card-focus");

  name_card_focus.style.marginTop = "1.5rem";

  const min = Math.floor(datas["relax"] / 60);
  const sec = datas["relax"] - min * 60;

  let relax_time;

  if (min) {
    relax_time = `${min}min e ${sec}s`;
  } else {
    relax_time = `${sec}s`;
  }

  card_focus_bg.classList.add("card-focus-bg-active");
  name_card_focus.innerHTML = `#${datas["id_treino"]} ${datas["name_treino"]}`;
  relax_card_focus.innerHTML = `Descanso: ${relax_time}`;

  const ul_list = card_focus_bg.querySelector(".card-body");
  const table = ul_list.querySelector("tbody");

  if (!datas["exercises"].length) {
    table.innerHTML =
      "<tr><td colspan='5' style='text-align: center;'>Não há exercícios</td></tr>";
  } else {
    datas["exercises"].forEach((e) => {
      table.innerHTML += `
      <tr>
        <td>#${e["id_exercise"]}</td>
        <td>${e["name_exercise"]}</td>
        <td>${e["series"]}</td>
        <td>${e["reps"]}</td>
        <td>${e["charge"]}kg</td>
      </tr>`;
    });
  }

  card_focus_bg.addEventListener("click", function (e) {
    if (e.target === this) {
      closeCardFocus(card_focus_bg);
    }
  });
}

// Add Event Edit
const btn_edit_prac = document.querySelector("#edit-prac");
btn_edit_prac.addEventListener("click", () => {
  handleEditPrac();
});

// Add Event Delete
const btn_delete_prac = document.querySelector("#delete-prac");
if (btn_delete_prac) {
  btn_delete_prac.addEventListener("click", () => {
    if (confirm("Deseja realmente excluir esse treino?")) {
      handleDeletePrac();
    }
  });
}

// Fecha Card Focus
function closeCardFocus(card_focus_bg) {
  card_focus_bg.classList.remove("card-focus-bg-active");
  const ul_list = card_focus_bg.querySelector(".card-body");
  const table = ul_list.querySelector("tbody");
  table.innerHTML = "";
}

// Function Build Card User
function buildPrac(datas, cont) {
  const li = document.createElement("li");
  const h3 = document.createElement("h3");
  const span = document.createElement("span");

  li.className = "card-item card-prac card-active";
  h3.className = "card-name font-1-s";
  span.className = "card-name font-2-xs";

  const ex_length = datas["exercises"].length;

  h3.innerHTML = `${datas["name_treino"]}`;
  span.innerHTML = `Exercício(s): ${ex_length}`;

  li.id = datas["id_treino"];

  li.addEventListener("click", () => {
    openFocusCard(datas);
  });

  li.append(h3, span);

  li.style.animation = `fadeInUp ${cont}s ease`;

  return li;
}

// Add Pracs
function addPracs(res) {
  const prac_list = document.querySelector("#prac-list");

  let cont = 1;

  if (res["status"] !== "error") {
    res.forEach((prac) => {
      prac_list.append(buildPrac(prac, cont * 0.2));
      cont++;
    });
  }
}

// Function Wait Select Reponse
export async function waitResponsePracs() {
  const loadingContainer = document
    .querySelector(".body-section-active")
    .querySelector(".loading-container");

  const prac_list = document.querySelector("#prac-list");
  prac_list.innerHTML = "";

  loadingToggle(loadingContainer);

  const res = await select();

  loadingToggle(loadingContainer);

  if (res) {
    addPracs(res);
    return;
  }
}

// Function Wait Select Reponse
export async function waitResponsePracsUser() {
  const loadingContainer = document
    .querySelector(".body-section-active")
    .querySelector(".loading-container");

  const prac_list = document.querySelector("#prac-list");
  prac_list.innerHTML = "";

  loadingToggle(loadingContainer);

  const res = await select_prac_user();

  loadingToggle(loadingContainer);

  if (res) {
    addPracs(res);
    return;
  }
}
