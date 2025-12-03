// Default URL
const API_URL = `${window.location.protocol}//${window.location.hostname}/projeto-ecogym/apis/profile/`;

// Function Send Datas API
export async function register_moviment(datas) {
  try {
    const res = await fetch(API_URL + "register_moviment.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(datas),
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

// Function Send Datas API
export async function select_calcs() {
  try {
    const res = await fetch(API_URL + "select_calcs.php", {
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

// Function Select Equips
export async function select_equips() {
  try {
    const res = await fetch(API_URL + "select_equips.php", {
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
