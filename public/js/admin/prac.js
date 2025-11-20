import { loadingToggle } from "../loading.js";
import { insert } from "../apis/prac.js";
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
    }
  });
