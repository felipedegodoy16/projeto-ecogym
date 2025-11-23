import { loadingToggle } from "../loading.js";
import { insert, select } from "../apis/prac.js";
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

// Function Build Card User
function buildPrac(datas) {
  const li = document.createElement("li");
  const h3 = document.createElement("h3");
  const span = document.createElement("span");

  li.className = "card-item card-prac card-active";
  h3.className = "card-name font-1-s";
  span.className = "card-name font-2-xs";

  const ex_length = datas["exercises"].length;

  h3.innerHTML = `${datas["name_treino"]}`;
  span.innerHTML = `Exercícios: ${ex_length}`;

  li.append(h3, span);

  return li;
}

// Add Pracs
function addPracs(res) {
  const prac_list = document.querySelector("#prac-list");

  res.forEach((prac) => {
    prac_list.append(buildPrac(prac));
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
