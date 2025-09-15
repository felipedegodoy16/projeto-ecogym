const menu_icon = document.querySelector('#div-icon-hamburguer');
const menu_nav = document.querySelector('#links-nav-hamburguer');
const span_icon = document.querySelector('#icon-hamburguer');

menu_icon.addEventListener('click', alterMenu);

function alterMenu() {
    span_icon.classList.toggle('active-icon');
    menu_nav.classList.toggle('active-menu');
}
