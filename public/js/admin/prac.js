import { loadingToggle } from "../loading.js";
import { insert, select, deletePrac } from "../apis/prac.js";
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
    const prac_name = document.querySelector("#prac-name").value;
    const prac_relax = document.querySelector("#prac-relax").value;

    // Captura exercícios
    const div_exercises = document.querySelectorAll(".div-form-exercise");
    const exercises = [];

    div_exercises.forEach((box) => {
      exercises.push({
        name: box.querySelector('input[name="exer-name"]').value,
        series: box.querySelector('input[name="exer-series"]').value,
        reps: box.querySelector('input[name="exer-reps"]').value,
        charge: box.querySelector('input[name="exer-charge"]').value,
      });
    });

    // Monta o JSON final
    const datas = {
      practice: {
        name: prac_name,
        relax: prac_relax,
      },
      exercises: exercises,
    };

    const res = await insert(datas);

    showModal(res["status"], res["title"], res["message"]);

    if (res["status"] === "success") {
      form.reset();
      formVisibility(form);

      const exer_list = document.querySelector(".exer-list");
      exer_list.innerHTML = "";

      addPracs(res["datas"]);
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

  // const btn_edit_prac = document.querySelector("#edit-prac");
  // btn_edit_prac.addEventListener("click", () => {
  //   handleEditUser(datas);
  // });
}

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

  res.forEach((prac) => {
    prac_list.append(buildPrac(prac, cont * 0.2));
    cont++;
  });
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
