//Função de Busca CEP
function buscaCep() {
  let inputCep = document.querySelector("input[name=update-cep]");
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
    const selectUf = document.querySelector("select[name=update-state]");

    document.querySelector("input[name=update-street]").value = "";
    document.querySelector("input[name=update-bairro]").value = "";
    document.querySelector("input[name=update-city]").value = "";
    selectUf.value = "fail-state";
    selectUf.style.color = "#595959";
  }
}

function preencheCampos(json) {
  if (json.localidade) {
    const selectUf = document.querySelector("select[name=update-state]");
    const options = selectUf.querySelectorAll("option");

    document.querySelector("input[name=update-street]").value = json.logradouro;
    document.querySelector("input[name=update-bairro]").value = json.bairro;
    document.querySelector("input[name=update-city]").value = json.localidade;
    options.forEach((element) => {
      if (element.getAttribute("value").toUpperCase() === json.uf) {
        selectUf.value = element.getAttribute("value");
        selectUf.style.color = "#dedede";
      }
    });
  }
}
