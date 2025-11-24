import {
  energy_generated,
  total_users,
  active_equips,
  ranking_users,
  ranking_equips,
  bar_chart,
} from "../apis/dashboard.js";

const formatDec = new Intl.NumberFormat("pt-BR", {
  style: "decimal",
  minimumFractionDigits: 0,
  maximumFractionDigits: 2,
});

const formatPerc = new Intl.NumberFormat("pt-BR", {
  style: "decimal",
  minimumFractionDigits: 0,
  maximumFractionDigits: 0,
});

async function callEnergyGenerated() {
  const energyValue = document.querySelector("#kwh-generated");
  const monthKwh = document.querySelector("#month-kwh");

  const res = await energy_generated();

  energyValue.textContent = `${formatDec.format(res["total_kwh"])} kWh`;
  monthKwh.textContent = `↑ ${formatPerc.format(
    (res["month_kwh"] / res["total_kwh"]) * 100
  )}% este mês`;
}

async function callTotalUsers() {
  const totalUsers = document.querySelector("#total-users");
  const newUsers = document.querySelector("#new-users");

  const res = await total_users();

  totalUsers.textContent = `${res["total_users"]}`;
  newUsers.textContent = `↑ ${res["new_users"]} novo(s) aluno(s)`;
}

async function callActiveEquips() {
  const activeEquips = document.querySelector("#active-equips");
  const percEquips = document.querySelector("#perc-equips");

  const res = await active_equips();

  activeEquips.textContent = `${res["active_equips"]}`;
  percEquips.textContent = `${formatPerc.format(
    (res["active_equips"] / res["total_equips"]) * 100
  )}% operacionais`;
}

callEnergyGenerated();
callTotalUsers();
callActiveEquips();

setInterval(callEnergyGenerated, 100000);

async function callBarChart() {
  const res = await bar_chart();

  const labels = [];
  const data = [];

  const currentYear = new Date().getFullYear();

  res.forEach((el) => {
    labels.push(el["ANO_MES"].replace(`${currentYear}-`, "").slice(0, 3));
    data.push(el["KWH"]);
  });

  const ctx = document.getElementById("barChart").getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "kWh",
          data: data,
          borderRadius: 6,
          backgroundColor: function (context) {
            return (
              getComputedStyle(document.documentElement).getPropertyValue(
                "--accent"
              ) || "#39b934"
            );
          },
          maxBarThickness: 44,
        },
      ],
    },
    options: {
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: "#9aa19a" } },
        y: {
          grid: { color: "rgba(255,255,255,0.03)" },
          ticks: { color: "#9aa19a" },
        },
      },
    },
  });
}

async function callDoghnutChart() {
  const res = await bar_chart();

  const labels = [];
  const data = [];

  const currentYear = new Date().getFullYear();

  res.forEach((el) => {
    labels.push(el["ANO_MES"].replace(`${currentYear}-`, "").slice(0, 3));
    data.push(el["KWH"]);
  });

  // Doghnut
  const dough = document.getElementById("doughnut").getContext("2d");
  const current = 3847;
  const target = 5000;
  const pct = Math.round((current / target) * 100);
  document.getElementById("pct").innerText = pct + "%";
  document.getElementById("raw").innerText = current + " / " + target + " kWh";

  new Chart(dough, {
    type: "doughnut",
    data: {
      labels: ["progresso", "restante"],
      datasets: [
        {
          data: [current, target - current],
          backgroundColor: ["#39b934", "rgba(255,255,255,0.07)"],
          hoverOffset: 4,
        },
      ],
    },
    options: { cutout: "75%", plugins: { legend: { display: false } } },
  });
}

callBarChart();
callDoghnutChart();

async function callRankingUsers() {
  const rankingUsers = document.querySelector("#rankingUsers");

  const res = await ranking_users();

  let colocacao = 1;

  res.forEach((element) => {
    rankingUsers.innerHTML += `
         <div class="ranking-item">
           <div class="rank-badge rank-${colocacao}">${colocacao}</div>
           <div class="ranking-info">
             <div class="ranking-name">${element["NOME"]}</div>
             <div class="ranking-detail">${element["CPF"]}</div>
           </div>
           <div class="ranking-value">${element["CALORIA"]} kWh</div>
         </div>`;
    colocacao++;
  });
}

async function callRankingEquips() {
  const rankingEquips = document.querySelector("#rankingEquips");

  const res = await ranking_equips();

  let colocacao = 1;

  res.forEach((element) => {
    rankingEquips.innerHTML += `
         <div class="ranking-item">
           <div class="rank-badge rank-${colocacao}">${colocacao}</div>
           <div class="ranking-info">
             <div class="ranking-name">${element["NOME"]}</div>
           </div>
           <div class="ranking-value">${element["CALORIA"]} kWh</div>
         </div>`;
    colocacao++;
  });
}

callRankingUsers();
callRankingEquips();
