if (window.goals.innerHTML == ": ") {
  // Comprueba si el contenido del elemento referenciado por la variable `window.goals` es igual a ": "

  window.goals.parentElement.style.textAlign = "center";
  // Si es igual, establece el atributo "textAlign" del elemento padre de `window.goals` en "center", lo que centra el contenido.

  window.goals.style.display = "none";
  // Además, oculta el elemento referenciado por `window.goals`.
} else {
  // Si el contenido de `window.goals` no es igual a ": ", se ejecuta este bloque.

  window.goals.style.display = "inline";
  // En este caso, muestra el elemento referenciado por `window.goals` estableciendo su atributo "display" en "inline".
}
