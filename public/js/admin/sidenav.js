import { waitResponseEquips } from "./equips.js";
import { waitResponsePracs } from "./prac.js";
import { waitResponseUsers } from "./users.js";

// Function Verify Link Active
function verifyActiveLink(link) {
  const body_active = document.querySelector(".body-section-active");

  if (link.innerText.toUpperCase() === "DASHBOARD") {
    const dashboard = document.querySelector("#dashboard-section");

    if (!dashboard.classList.contains("body-section-active")) {
      body_active.classList.remove("body-section-active");
      dashboard.classList.add("body-section-active");
    }
  } else if (link.innerText.toUpperCase() === "USUÁRIOS") {
    const users = document.querySelector("#users-section");
    if (!users.classList.contains("body-section-active")) {
      body_active.classList.remove("body-section-active");
      users.classList.add("body-section-active");
      waitResponseUsers();
    }
  } else if (link.innerText.toUpperCase() === "EQUIPAMENTOS") {
    const equips = document.querySelector("#equips-section");

    if (!equips.classList.contains("body-section-active")) {
      body_active.classList.remove("body-section-active");
      equips.classList.add("body-section-active");
      waitResponseEquips();
    }
  } else if (link.innerText.toUpperCase() === "TREINOS") {
    const prac = document.querySelector("#prac-section");

    if (!prac.classList.contains("body-section-active")) {
      body_active.classList.remove("body-section-active");
      prac.classList.add("body-section-active");
      waitResponsePracs();
    }
  }
}

// Function Active Link Sidenav
const sidenav = document.querySelector(".side-nav-admin");
const list_links_sidenav = sidenav.querySelectorAll("li");

list_links_sidenav.forEach((li) => {
  li.addEventListener("click", activeLinkSidenav);
});

function activeLinkSidenav(e) {
  const active_link = document.querySelector(".active-link-admin");
  active_link.classList.remove("active-link-admin");

  let element_click = e.target;
  if (element_click.tagName === "svg") element_click = element_click.parentNode;
  else if (element_click.tagName === "path")
    element_click = element_click.parentNode.parentNode;

  element_click.classList.add("active-link-admin");

  verifyActiveLink(element_click);
}
