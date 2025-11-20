const div_btn_add_exercise = document.querySelector(".div-btn-add-exercise");
div_btn_add_exercise
  .querySelector("button")
  .addEventListener("click", addExercise);

function removeExer(id) {
  document.getElementById("exer_" + id).remove();
}

let cont = 0;

function addExercise(e) {
  e.preventDefault();

  cont++;

  const div = document.createElement("div");
  div.classList.add("div-form-exercise");
  div.setAttribute("id", "exer_" + cont);

  div.innerHTML = `
    <div class="form-group">
      <label class="form-label" for="exer-name">Exercício</label>
      <input type="text" class="form-input" name="exer-name" placeholder="Exercício">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="form-group">
      <label class="form-label" for="exer-series">Séries</label>
      <input type="text" class="form-input" name="exer-series" data-mask="00" placeholder="00">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="form-group">
      <label class="form-label" for="exer-reps">Repetições</label>
      <input type="text" class="form-input" name="exer-reps" data-mask="00" placeholder="00">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="form-group">
      <label class="form-label" for="exer-charge">Carga (kg)</label>
      <input type="text" class="form-input" name="exer-charge" data-mask="00" placeholder="00">
      <span class="font-2-xs warning-data">Preencha este campo</span>
    </div>

    <div class="btn-remove-exer-form">
      <button type="button" class="button btn-close" onclick="removeExer(${cont})">Remover Exercício</button>
    </div>
  `;

  document.querySelector(".exer-list").appendChild(div);
}
