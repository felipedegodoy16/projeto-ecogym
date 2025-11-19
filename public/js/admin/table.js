import { loadingToggle } from "../loading.js";
import { showModal } from "../modal.js";
import { returnRanking } from "../apis/ranking.js";

// Function Create Table
function createTable(datas) {
  let colocacao = 1;
  let li = `
  <li>
    <h2 class="font-1-s cor-3" style="text-align: center;">Ranking Alunos</h2>
    <div class="table-container">
      <table class="table-rankings">
        <thead class="font-1-xs">
          <tr>
            <th>Colocação</th>
            <th>#ID</th>
            <th>Nome</th>
            <th>Energia Gerada</th>
          </tr>
        </thead>
        <tbody class="font-2-s">
    `;

  let porc = datas[0]["CALORIA"] / 100;

  datas.map((d) => {
    const tr = `
      <tr>
        <td>
          <div class="rank-cell">
            <div class="rank-badge">${colocacao++}</div>
          </div>
        </td>
        <td><span class="id-badge">#${d["ID_USUARIO"]}</span></td>
        <td>${d["NOME"]}</td>
        <td>
          <div class="energy-cell">
            <span class="energy-value">${d["CALORIA"].toFixed(2)}</span>
            <span class="energy-unit">kWh</span>
            <div class="energy-bar">
              <div class="energy-fill" style="width: ${(
                d["CALORIA"] / porc
              ).toFixed(2)}%;"></div>
            </div>
          </div>
        </td>
      </tr>`;

    li += tr;
  });

  li += `
        </tbody>
      </table>
    </div>
  </li>`;

  const ul = document.querySelector("#dashboards-list");
  ul.innerHTML += li;
}

// Function Call Ranking
export async function callRanking() {
  const body_active = document.querySelector(".body-section-active");
  const loadingContainer = body_active.querySelector(".loading-container");

  loadingToggle(loadingContainer);

  const res = await returnRanking();

  loadingToggle(loadingContainer);

  if (res["status"] !== "error") {
    createTable(res);
    return;
  }

  showModal(res[("status", res["title"], res["message"])]);
}
