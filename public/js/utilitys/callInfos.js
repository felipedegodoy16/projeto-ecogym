import {
  energy_generated,
  total_users,
  active_equips,
  ranking_users,
  ranking_equips,
  bar_chart,
  doghnut_chart,
  energy_generated_user,
  position_ranking,
  bar_chart_user,
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

export async function callEnergyGenerated() {
  const energyValue = document.querySelector("#kwh-generated");
  const monthKwh = document.querySelector("#month-kwh");

  const res = await energy_generated();

  energyValue.textContent = `${formatDec.format(res["total_kwh"])} kWh`;
  monthKwh.textContent = `↑ ${formatPerc.format(
    (res["month_kwh"] / res["total_kwh"]) * 100
  )}% este mês`;
}

export async function callTotalUsers() {
  const totalUsers = document.querySelector("#total-users");
  const newUsers = document.querySelector("#new-users");

  const res = await total_users();

  totalUsers.textContent = `${res["total_users"]}`;
  newUsers.textContent = `↑ ${res["new_users"]} novo(s) aluno(s)`;
}

export async function callActiveEquips() {
  const activeEquips = document.querySelector("#active-equips");
  const percEquips = document.querySelector("#perc-equips");

  const res = await active_equips();

  activeEquips.textContent = `${res["active_equips"]}`;
  percEquips.textContent = `${formatPerc.format(
    (res["active_equips"] / res["total_equips"]) * 100
  )}% operacionais`;
}

export async function callBarChart() {
  const res = await bar_chart();

  const labels = [];
  const data = [];

  res.forEach((el) => {
    labels.push(el["MES"]);
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
          backgroundColor: "#39b934",
          maxBarThickness: 44,
        },
      ],
    },
    options: {
      animation: {
        duration: 800,
        easing: "easeOutCubic",
      },
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

export async function callDoghnutChart() {
  const res = await doghnut_chart();

  // Doghnut
  const dough = document.getElementById("doughnut").getContext("2d");
  const current = res;
  const target = 5;
  const pct = Math.round((current / target) * 100);
  document.getElementById("pct").innerText = pct + "%";
  document.getElementById("raw").innerText =
    formatDec.format(current) + " / " + target + " kWh";

  let goal = 0;
  let data_chart = target - current;

  if (target - current > 0) {
    goal = `Faltam: <strong>${formatDec.format(target - current)} kWh</strong>`;
  } else {
    goal = `<strong>${formatDec.format(
      current - target
    )} kWh</strong> Acima da meta.`;
    data_chart = 0;
  }

  document.querySelector("#meta-legend").innerText = `Meta: ${target} kWh`;
  document.querySelector("#generated-legend").innerHTML = goal;

  new Chart(dough, {
    type: "doughnut",
    data: {
      labels: ["progresso", "restante"],
      datasets: [
        {
          data: [current, data_chart],
          backgroundColor: ["#39b934", "rgba(255,255,255,0.1)"],
          hoverOffset: 4,
          borderWidth: 0,
          borderRadius: 50,
          borderAlign: "inner",
        },
      ],
    },
    options: {
      cutout: "75%",
      animation: {
        animateRotate: true,
        animateScale: true,
        duration: 1200,
        easing: "easeOutQuart",
      },
      plugins: { legend: { display: false } },
    },
  });
}

export async function callRankingUsers() {
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
           <div class="ranking-value">${formatDec.format(
             element["CALORIA"] * 0.001163
           )} kWh</div>
         </div>`;
    colocacao++;
  });
}

export async function callRankingEquips() {
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
           <div class="ranking-value">${formatDec.format(
             element["CALORIA"] * 0.001163
           )} kWh</div>
         </div>`;
    colocacao++;
  });
}

export async function callGeneratedUserMonth() {
  const energyValue = document.querySelector("#kwh-generated-month");
  const monthKwh = document.querySelector("#ranking-position");

  const res = await energy_generated_user();

  const pos = await position_ranking();

  energyValue.textContent = `${formatDec.format(res["user_kwh_month"])} kWh`;
  monthKwh.innerHTML = `<span class="position-ranking font-1-s">#${pos["POSICAO"]}</span> no ranking`;
}

export async function callBarChartUser() {
  const res = await bar_chart_user();

  const dias = ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"];
  const reset = [0, 0, 0, 0, 0, 0, 0];

  const labels = [];
  const data = [];

  let ctx = document.getElementById("barChart");

  if (res["status"]) {
    dias.forEach((d) => {
      labels.push(d);
    });
    reset.forEach((d) => {
      data.push(d);
    });
  } else {
    res.forEach((el) => {
      labels.push(el["DIA"]);
      data.push(el["KWH"]);
    });
  }

  ctx = ctx.getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "kWh",
          data: data,
          borderRadius: 6,
          backgroundColor: "#39b934",
          maxBarThickness: 44,
        },
      ],
    },
    options: {
      animation: {
        duration: 800,
        easing: "easeOutCubic",
      },
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
