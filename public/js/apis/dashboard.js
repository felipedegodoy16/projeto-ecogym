// Default URL
const API_URL = "http://localhost/projeto-ecogym/apis/dashboard/";

// Function Calc Energy Generated
export async function energy_generated() {
  try {
    const res = await fetch(API_URL + "energy_generated.php", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    });
    return await res.json();
  } catch (erro) {
    console.log(erro);
    return {
      status: "error",
      title: "Erro!",
      message: "Erro no servidor, tente novamente mais tarde.",
    };
  }
}

// Function Total Users
export async function total_users() {
  try {
    const res = await fetch(API_URL + "total_users.php", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    });
    return await res.json();
  } catch (erro) {
    console.log(erro);
    return {
      status: "error",
      title: "Erro!",
      message: "Erro no servidor, tente novamente mais tarde.",
    };
  }
}

// Function Active Equips
export async function active_equips() {
  try {
    const res = await fetch(API_URL + "active_equips.php", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    });
    return await res.json();
  } catch (erro) {
    console.log(erro);
    return {
      status: "error",
      title: "Erro!",
      message: "Erro no servidor, tente novamente mais tarde.",
    };
  }
}
