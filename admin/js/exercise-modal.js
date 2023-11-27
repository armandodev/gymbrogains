document.addEventListener("DOMContentLoaded", () => {
  modal = document.querySelector("#modal-form");
  closeModal = document.querySelector("#close-modal");
  showModal = document.querySelector("#show-modal");

  showModal.addEventListener("click", () => {
    modal.open();
    body.style.overflow = "hidden";
  });

  closeModal.addEventListener("click", () => {
    modal.close();
    body.style.overflow = "auto";
  });
});
