import {
  energy_generated,
  total_users,
  active_equips,
} from "../apis/dashboard.js";

async function callEnergyGenerated() {
  const energyValue = document.querySelector("#kwh-generated");
  const res = await energy_generated();

  energyValue.textContent = `${res.toFixed(3).replace(".", ",")} kWh`;
}

async function callTotalUsers() {
  const totalUsers = document.querySelector("#total-users");
  const res = await total_users();

  totalUsers.textContent = `${res}`;
}

async function callActiveEquips() {
  const activeEquips = document.querySelector("#active-equips");
  const percEquips = document.querySelector("#perc-equips");

  const res = await active_equips();

  activeEquips.textContent = `${res["active_equips"]}`;
  percEquips.textContent = `${Math.floor(
    (res["active_equips"] / res["total_equips"]) * 100
  )}% operacionais`;
}

callEnergyGenerated();
callTotalUsers();
callActiveEquips();

setInterval(callEnergyGenerated, 100000);
