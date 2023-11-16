function bannerSwitcher() {
  // Esta función se encarga de cambiar el banner en un slider.

  // Encuentra el elemento de entrada de tipo radio (radio input) que está marcado como seleccionado y luego busca el siguiente elemento con la clase "slider-input".
  next = $(".slider-input").filter(":checked").next(".slider-input");

  // Si se encontró un elemento siguiente, marca ese elemento como seleccionado.
  if (next.length) next.prop("checked", true);
  // Si no se encontró ningún elemento siguiente, selecciona el primer elemento con la clase "slider-input".
  else $(".slider-input").first().prop("checked", true);
}

// Establece un temporizador que ejecutará la función "bannerSwitcher" cada 5000 milisegundos (5 segundos).
var bannerTimer = setInterval(bannerSwitcher, 5000);

// Asocia un controlador de eventos al hacer clic en una etiqueta (label) dentro del elemento de navegación (nav).
$("nav .controls label").click(function () {
  // Cuando se hace clic en una etiqueta, se detiene el temporizador actual.
  clearInterval(bannerTimer);

  // Luego, se inicia un nuevo temporizador que ejecutará la función "bannerSwitcher" cada 5000 milisegundos (5 segundos).
  bannerTimer = setInterval(bannerSwitcher, 5000);
});
