document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("modal-form");
  const btn = document.getElementById("add-exercise");
  const closeModalBtn = document.getElementById("close-modal");

  btn.addEventListener("click", (event) => {
    event.preventDefault();

    modal.showModal();
    modal.style.display = "grid";
    modal.style.position = "relative";
  });
});
