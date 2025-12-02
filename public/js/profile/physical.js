import { validateInput } from "../validFields.js";
import { save_calc, select_calcs } from "./../apis/physical.js";
import { showModal } from "./../modal.js";

const formatDec = new Intl.NumberFormat("pt-BR", {
  style: "decimal",
  minimumFractionDigits: 0,
  maximumFractionDigits: 2,
});

// Calc IMC
function calcIMC(weight, heightM) {
  return weight / (heightM * heightM);
}

// Calc Fat Perc - US Navy
function fatPercMan(waist, neck, height) {
  return (
    86.01 * Math.log10(waist - neck) - 70.041 * Math.log10(height * 100) + 36.76
  );
}

function fatPercWoman(waist, neck, hip, height) {
  return (
    163.205 * Math.log10(waist + hip - neck) -
    97.684 * Math.log10(height * 100) -
    78.387
  );
}

// Fat Weight
function fatWeight(weight, fatPerc) {
  return weight * (fatPerc / 100);
}

// Function Handle Calc
async function handleCalc(e) {
  e.preventDefault();

  const form = e.target;

  let errorInput = validateInput(form);

  if (errorInput) {
    showModal(
      "error",
      "Campos incorretos!",
      "Algum(ns) campo(s) do formulário não foram preenchido(s) corretamente."
    );
    return;
  }

  const btn = form.querySelector(".btn-add-edit");
  btn.innerText = "Calculando...";

  const weight = document.querySelector("#physical-weight").value;
  const height = document.querySelector("#physical-height").value;
  const waist = document.querySelector("#physical-waist").value;
  const neck = document.querySelector("#physical-neck").value;
  const input_hip = document.querySelector("#physical-hip");

  const imc = formatDec.format(calcIMC(weight, height));

  const date = new Date();

  let res;
  let fatPerc;
  let fatWeightRes;

  if (input_hip) {
    const hip = input_hip.value;
    fatPerc = fatPercWoman(waist, neck, hip, height);
    if (fatPerc === -Infinity || fatPerc === Infinity) {
      showModal(
        "error",
        "Inválido!",
        "Não foi possível efetuar o cálculo, verifique os campos e tente novamente."
      );
      return;
    }
    fatWeightRes = fatWeight(weight, fatPerc);

    fatPerc = formatDec.format(fatPerc);
    fatWeightRes = formatDec.format(fatWeightRes);

    if (fatWeightRes === "NaN") {
      showModal(
        "error",
        "Inválido!",
        "Não foi possível efetuar o cálculo, verifique os campos e tente novamente."
      );
      return;
    }
    res = await save_calc({
      weight,
      waist,
      neck,
      hip,
      imc,
      fatPerc,
      fatWeightRes,
    });
  } else {
    fatPerc = fatPercMan(waist, neck, height);
    if (fatPerc === -Infinity || fatPerc === Infinity) {
      showModal(
        "error",
        "Inválido!",
        "Não foi possível efetuar o cálculo, verifique os campos e tente novamente 1."
      );
      return;
    }
    fatWeightRes = fatWeight(weight, fatPerc);

    fatPerc = formatDec.format(fatPerc);
    fatWeightRes = formatDec.format(fatWeightRes);

    if (fatWeightRes === "NaN") {
      showModal(
        "error",
        "Inválido!",
        "Não foi possível efetuar o cálculo, verifique os campos e tente novamente 2."
      );
      return;
    }
    res = await save_calc({
      weight,
      waist,
      neck,
      imc,
      fatPerc,
      fatWeightRes,
    });
  }

  btn.innerText = "Calcular";

  showModal(res["status"], res["title"], res["message"]);

  const tbody = document.querySelector("#calc-history");

  if (res["status"] === "success") {
    form.reset();

    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}</td>
      <td>${weight} kg</td>
      <td>${waist} cm</td>
      <td>${neck} cm</td>
      <td>${imc}</td>
      <td>${fatPerc}%</td>
      <td>${fatWeightRes} kg</td>
    `;

    tbody.prepend(tr);
  }
}

// Form Calc
const formCalc = document.querySelector("#physicalCalc");
formCalc.addEventListener("submit", handleCalc);

// Call Calcs Function
export async function callCalcsUser() {
  const datas = await select_calcs();

  const tbody = document.querySelector("#calc-history");

  tbody.innerHTML = "";

  if (datas.hasOwnProperty("calcs")) {
    datas["calcs"].forEach((e) => {
      const objectDate = new Date(e["DATA_CALCULO"]);

      const formattedDate = new Intl.DateTimeFormat("pt-BR", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      }).format(objectDate);

      tbody.innerHTML += `
        <tr>
          <td>${formattedDate}</td>
          <td>${e["PESO"]} kg</td>
          <td>${e["CINTURA"]} cm</td>
          <td>${e["PESCOCO"]} cm</td>
          <td>${e["IMC"]}</td>
          <td>${e["PERC_GORDURA"]}%</td>
          <td>${e["KILO_GORDURA"]} kg</td>
        </tr>`;
    });

    const current_calc = datas["calcs"][0];

    const current_imc = document.querySelector("#current-imc");
    current_imc.textContent = current_calc["IMC"];

    const stat_imc = document.querySelector("#stat-imc");
    if (current_calc["IMC"] < 18.5) stat_imc.textContent = "Abaixo do Peso";
    else if (current_calc["IMC"] < 25) stat_imc.textContent = "Peso Normal";
    else if (current_calc["IMC"] < 30) stat_imc.textContent = "Sobrepeso";
    else if (current_calc["IMC"] < 35)
      stat_imc.textContent = "Obesidade Grau I";
    else stat_imc.textContent = "Obesidade Grau III";

    const current_fat_perc = document.querySelector("#current-fat-perc");
    current_fat_perc.textContent = `${current_calc["PERC_GORDURA"]}%`;

    const current_fat_kg = document.querySelector("#current-fat-kg");
    current_fat_kg.textContent = `${current_calc["KILO_GORDURA"]} kg`;
  }
}
