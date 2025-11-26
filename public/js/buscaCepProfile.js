//Função de Busca CEP
function buscaCep() {
  let inputCep = document.querySelector("input[name=register-cep]");
  let cep = inputCep.value.replace(/[^0-9]/g, "");

  if (cep.length == 8) {
    let url = "http://viacep.com.br/ws/" + cep + "/json";
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) preencheCampos(JSON.parse(xhr.responseText));
      }
    };
    xhr.send();
  } else {
    const selectUf = document.querySelector("select[name=register-state]");

    document.querySelector("input[name=register-street]").value = "";
    document.querySelector("input[name=register-bairro]").value = "";
    document.querySelector("input[name=register-city]").value = "";
    selectUf.value = "fail-state";
    selectUf.style.color = "#595959";
  }
}

function preencheCampos(json) {
  if (json.localidade) {
    const selectUf = document.querySelector("select[name=register-state]");
    const options = selectUf.querySelectorAll("option");

    document.querySelector("input[name=register-street]").value =
      json.logradouro;
    document.querySelector("input[name=register-bairro]").value = json.bairro;
    document.querySelector("input[name=register-city]").value = json.localidade;
    options.forEach((element) => {
      if (element.getAttribute("value").toUpperCase() === json.uf) {
        selectUf.value = element.getAttribute("value");
        selectUf.style.color = "#dedede";
      }
    });
  }
}
