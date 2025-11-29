import { waitResponsePracsUser } from "../admin/prac.js";

// Function Verify Link Active
function verifyActiveLink(link) {
  const body_active = document.querySelector(".body-section-active");

  if (link.innerText.toUpperCase() === "INFORMAÇÕES") {
    const dashboard = document.querySelector("#dashboard-section");

    if (!dashboard.classList.contains("body-section-active")) {
      body_active.classList.remove("body-section-active");
      dashboard.classList.add("body-section-active");
    }
  } else if (link.innerText.toUpperCase() === "MEU PERFIL") {
    const users = document.querySelector("#profile-section");
    if (!users.classList.contains("body-section-active")) {
      body_active.classList.remove("body-section-active");
      users.classList.add("body-section-active");
    }
  } else if (link.innerText.toUpperCase() === "MEUS TREINOS") {
    const users = document.querySelector("#prac-section");
    if (!users.classList.contains("body-section-active")) {
      body_active.classList.remove("body-section-active");
      users.classList.add("body-section-active");
      waitResponsePracsUser();
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
  if (e.target.tagName === "LI") return;

  const active_link = document.querySelector(".active-link-admin");
  active_link.classList.remove("active-link-admin");

  let element_click = e.target;
  if (element_click.tagName === "svg") element_click = element_click.parentNode;
  else if (element_click.tagName === "path")
    element_click = element_click.parentNode.parentNode;

  element_click.classList.add("active-link-admin");

  verifyActiveLink(element_click);
}
