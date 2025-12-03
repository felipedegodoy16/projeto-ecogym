import {
  register_moviment,
  select_equips,
  select_moviments,
} from "../apis/moviment.js";
import { showModal } from "../modal.js";
import { validateInput, validateSelect } from "../validFields.js";

async function handleMoviment(e) {
  e.preventDefault();

  const form = e.target;

  let errorInput = validateInput(form);
  let erroSelect = validateSelect(form);

  if (errorInput || erroSelect) {
    showModal(
      "error",
      "Campos incorretos!",
      "Algum(ns) campo(s) do formulário não foram preenchido(s) corretamente."
    );
    return;
  }

  const btn = form.querySelector(".btn-add-edit");
  btn.innerText = "Registrando...";

  const datas = Object.fromEntries(new FormData(form));
  const res = await register_moviment(datas);

  btn.innerText = "Registrar";

  showModal(res["status"], res["title"], res["message"]);

  const tbody = document.querySelector("#movi-history");

  if (res["status"] === "success") {
    form.reset();

    const tr = document.createElement("tr");

    const objectDate = new Date(res["date"] + "T00:00:00");

    const formattedDate = new Intl.DateTimeFormat("pt-BR", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric",
    }).format(objectDate);

    tr.innerHTML = `
        <td>${formattedDate}</td>
        <td>${res["equip"]["NOME"]}</td>
        <td>${datas["movi-kcal"]}</td>
      `;

    tbody.prepend(tr);
  }
}

// Form Moviment
const formMovi = document.querySelector("#formMoviment");
formMovi.addEventListener("submit", handleMoviment);

// Call Calcs Function
export async function callMovimentsUser() {
  const datas = await select_moviments();

  const tbody = document.querySelector("#movi-history");

  tbody.innerHTML = "";

  if (datas.hasOwnProperty("movis")) {
    datas["movis"].forEach((e) => {
      const objectDate = new Date(e["DATA_MOVIMENTO"]);

      const formattedDate = new Intl.DateTimeFormat("pt-BR", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      }).format(objectDate);

      tbody.innerHTML += `
        <tr>
          <td>${formattedDate}</td>
          <td>${e["NOME"]}</td>
          <td>${e["CALORIA_GASTA"]}</td>
        </tr>`;
    });
  }

  const equips = await select_equips();

  const select = document.querySelector("#movi-equip");

  equips.forEach((e) => {
    select.innerHTML += `<option value="${e["ID_EQUIPAMENTO"]}">${e["ID_EQUIPAMENTO"]} - ${e["NOME"]}</option>`;
  });
}
