// Function ValidateInput
export function validateInput(e) {
  let error = 0;

  const inputs = e.querySelectorAll("input");
  inputs.forEach((input) => {
    if (!input.value && input.getAttribute("type") !== "hidden") {
      const errorElement = input.parentNode.querySelector(".warning-data");

      if (errorElement) {
        errorElement.style.display = "block";
        input.classList.add("warning-field");
        input.addEventListener("focus", function (e) {
          e.target.classList.remove("warning-field");
          errorElement.style.display = "none";
        });

        error = 1;
      }
    }
  });

  return error;
}

// Function ValidateSelect
export function validateSelect(e) {
  let error = 0;

  const selects = e.querySelectorAll("select");
  selects.forEach((select) => {
    if (!select.selectedIndex) {
      const errorElement = select.parentNode.querySelector(".warning-data");

      errorElement.style.display = "block";
      select.classList.add("warning-field");
      select.addEventListener("focus", function (e) {
        e.target.classList.remove("warning-field");
        errorElement.style.display = "none";
      });

      error = 1;
    }
  });

  return error;
}
