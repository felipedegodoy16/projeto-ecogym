// Default URL
const API_URL = "http://localhost/projeto-ecogym/apis/prac/";

// Function Send Datas API
export async function insert(datas) {
  try {
    const res = await fetch(API_URL + "insert.php", {
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

// Function Select Pracs
export async function select() {
  try {
    const res = await fetch(API_URL + "select.php", {
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

// Function Insert Equipment
export async function alter(datas, id) {
  try {
    const res = await fetch(API_URL + "alter.php?id=" + id, {
      method: "PUT",
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

// Function Delete Equipments
export async function deleteUser(id) {
  try {
    const res = await fetch(API_URL + "delete.php", {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: `id=${id}`,
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

export async function login(datas) {
  try {
    const res = await fetch(API_URL + "login.php", {
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
