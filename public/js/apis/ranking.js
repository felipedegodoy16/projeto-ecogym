// Default URL
const API_URL = "http://localhost/projeto-ecogym/apis/users/";

// Function Return Ranking
export async function returnRanking() {
  try {
    const res = await fetch(API_URL + "returnRanking.php");
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
