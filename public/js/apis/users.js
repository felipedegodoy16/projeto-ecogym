// Default URL
const API_URL = `${window.location.protocol}//${window.location.hostname}/projeto-ecogym/apis/users/`;

// Function Send Datas API
export async function insert(datas) {
  try {
    let res;
    if (datas["register-cpf"]) {
      res = await fetch(API_URL + "insertFull.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(datas),
      });
    } else {
      res = await fetch(API_URL + "insert.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(datas),
      });
    }

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

// Function Select Users
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

// Function Alter User
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

// Function Delete User
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

// Function Login
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

// Function Alter Own
export async function alter_own(datas) {
  try {
    const res = await fetch(API_URL + "alterOwn.php", {
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

// Function Return User
export async function return_user() {
  try {
    const res = await fetch(API_URL + "return_user.php", {
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

// Function Send Message
export async function send_message(datas) {
  try {
    const res = await fetch(API_URL + "send_message.php", {
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

// Function Recover Password
export async function recover_password(email) {
  try {
    const res = await fetch(API_URL + "recover_password.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: `email=${email}`,
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

// Function Recover Password
export async function valid_token(token) {
  try {
    const res = await fetch(API_URL + `valid_token.php?token=${token}`, {
      method: "POST",
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

// Function Recover Password
export async function alterPassword(datas) {
  try {
    const res = await fetch(API_URL + "alter_password.php", {
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
