// Perguntas Frequentes
const perguntas = document.querySelectorAll(".faq button");

function ativarPergunta(event) {
  const pergunta = event.currentTarget;
  const controls = pergunta.getAttribute("aria-controls");
  const resposta = document.getElementById(controls);

  resposta.classList.toggle("active-faq");
  const ativa = resposta.classList.contains("active-faq");
  pergunta.setAttribute("aria-expanded", ativa);
}

perguntas.forEach((pergunta) => {
  pergunta.addEventListener("click", ativarPergunta);
});
