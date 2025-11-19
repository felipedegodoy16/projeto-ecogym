const menu_icon = document.querySelector("#div-icon-hamburguer");
const menu_nav = document.querySelector("#links-nav-hamburguer");
const span_icon = document.querySelector("#icon-hamburguer");

menu_icon.addEventListener("click", alterMenu);

function alterMenu() {
  span_icon.classList.toggle("active-icon");
  menu_nav.classList.toggle("active-menu");
}

window.addEventListener("scroll", changeBackgroundNavbar);
window.addEventListener("resize", changeBackgroundNavbar);
const header = document.querySelector(".header-bg");

function changeBackgroundNavbar() {
  if (window.scrollY > 10 || window.screen.width <= 1024) {
    header.style.background = "#000";
  } else {
    header.style.background = "transparent";
  }
}

// Function Active Link
const links_nav = menu_nav.querySelectorAll("li");
let validForeach = 1;
links_nav.forEach((link) => {
  if (validForeach) {
    const url = document.URL.replace("?logout=1", "");
    if (url === "http://localhost/projeto-ecogym/public/") {
      link.children[0].classList.add("active-link");
      validForeach = 0;
    }
    if (url.includes(link.children[0].href)) {
      link.children[0].classList.add("active-link");
    }
  }
});
