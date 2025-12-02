const menu_icon = document.querySelector("#div-hamburguer-sidenav");
const nav_links = document.querySelector("#sidenav-links");
const span_icon = document.querySelector("#icon-hamburguer-sidenav");

menu_icon.addEventListener("click", alterMenu);

function alterMenu() {
  span_icon.classList.toggle("active-icon");
  nav_links.classList.toggle("active-sidenav");
}
