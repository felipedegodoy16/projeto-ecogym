const menu_icon = document.querySelector('#div-icon-hamburguer');
const menu_nav = document.querySelector('#links-nav-hamburguer');
const span_icon = document.querySelector('#icon-hamburguer');

menu_icon.addEventListener('click', alterMenu);

function alterMenu() {
    span_icon.classList.toggle('active-icon');
    menu_nav.classList.toggle('active-menu');
}

window.addEventListener('scroll', changeBackgroundNavbar);
const header = document.querySelector('.header-bg');

function changeBackgroundNavbar() {
    if (window.scrollY > 10) {
        header.style.background = '#000';
    } else {
        header.style.background = 'transparent';
    }
}
