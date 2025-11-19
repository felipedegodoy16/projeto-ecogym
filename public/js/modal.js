// Mostra modal de sucesso ou erro
export function showModal(type, title, message) {
  const overlay = document.querySelector(".modal-overlay");
  const modal = document.querySelector(".modal");
  const icon = document.querySelector(".modal-icon");
  const modalTitle = document.querySelector(".modal-title");
  const modalMessage = document.querySelector(".modal-message");
  const modalButton = document.querySelector(".btn-modal");

  // Limpa classes anteriores
  modal.className = "modal " + type;
  modalButton.className = "button btn-modal " + type;

  // Define conteúdo
  modalTitle.textContent = title;
  modalMessage.textContent = message;
  modalButton.textContent =
    type === "success" ? "Continuar" : "Tentar Novamente";

  // Cria ícone animado
  if (type === "success") {
    icon.innerHTML = `
                    <div class="success-icon">
                        <div class="success-check"></div>
                    </div>
                `;
  } else {
    icon.innerHTML = `
                    <div class="error-icon">
                        <div class="error-x">
                            <div class="error-line"></div>
                            <div class="error-line"></div>
                        </div>
                    </div>
                `;
  }

  // Mostra modal
  overlay.classList.add("active-modal");

  // Fecha modal ao clicar fora
  overlay.addEventListener("click", function (e) {
    if (e.target === this) {
      closeModal(overlay);
    }
  });

  // Button para fechar o modal
  modalButton.addEventListener("click", () => {
    closeModal(overlay);
  });

  // Fecha modal com ESC
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      closeModal(overlay);
    }
  });
}

// Fecha modal
function closeModal(overlay) {
  overlay.classList.remove("active-modal");
}
