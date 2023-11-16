$(document).ready(() => {
  // Espera a que el documento esté completamente cargado

  const urlParams = new URLSearchParams(window.location.search);
  // Obtiene los parámetros de la URL

  const currentPage = parseInt(urlParams.get("page")) || 1;
  // Obtiene el valor del parámetro "page" de la URL y lo convierte a un número entero. Si el parámetro no está presente, se establece como 1.

  const pageLinks = $(".page-link");
  // Obtiene todos los elementos con la clase "page-link"

  pageLinks.each(function (index, link) {
    // Itera sobre cada elemento con la clase "page-link"

    if (index + 1 === currentPage) {
      // Compara el índice actual + 1 (para igualarlo al número de página) con la página actual
      $(link).addClass("active");
      // Si son iguales, agrega la clase "active" al enlace, indicando la página actual.
    }

    $(link).on("click", function () {
      // Agrega un controlador de clic a cada enlace

      const page = parseInt($(this).text());
      // Obtiene el número de página del texto del enlace en el que se hizo clic y lo convierte a un número.

      history.pushState({}, "", `exercises.php?page=${page}`);
      // Actualiza la URL en la barra de direcciones del navegador sin recargar la página, utilizando el nuevo número de página.

      pageLinks.removeClass("active");
      // Elimina la clase "active" de todos los enlaces.

      $(this).addClass("active");
      // Agrega la clase "active" al enlace en el que se hizo clic para indicar la página actual.
    });
  });
});
