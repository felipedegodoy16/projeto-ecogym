import {
  energy_generated,
  total_users,
  active_equips,
  ranking_users,
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

callRankingUsers();
