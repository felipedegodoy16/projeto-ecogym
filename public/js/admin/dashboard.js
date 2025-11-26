import {
  callEnergyGenerated,
  callTotalUsers,
  callActiveEquips,
  callBarChart,
  callDoghnutChart,
  callRankingUsers,
  callRankingEquips,
} from "../utilitys/callInfos.js";

document.addEventListener("DOMContentLoaded", () => {
  callEnergyGenerated();
  callTotalUsers();
  callActiveEquips();
  setInterval(callEnergyGenerated, 100000);

  callBarChart();
  callDoghnutChart();
  callRankingUsers();
  callRankingEquips();
});
