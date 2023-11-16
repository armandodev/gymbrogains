$(document).ready(function () {
  // Espera a que el documento esté completamente cargado

  $(".publication-footer-reaction-button").click(function () {
    // Agrega un controlador de clic a los elementos con la clase "publication-footer-reaction-button"

    const buttonId = $(this).attr("id");
    // Obtiene el ID del botón en el que se hizo clic

    $.ajax({
      // Realiza una solicitud AJAX
      url: "./actions/increment-like-count.php",
      // URL del archivo PHP al que se enviará la solicitud
      method: "POST",
      // Método HTTP (POST) para enviar datos al servidor
      data: {
        buttonId: buttonId,
      },
      // Datos que se enviarán al servidor, en este caso, el ID del botón

      success: () => {
        // Función que se ejecuta si la solicitud AJAX es exitosa

        const currentCount = parseInt($("#" + buttonId + "-count").text());
        // Obtiene el contenido actual del elemento con el ID "buttonId-count" y lo convierte en un número entero

        $("#" + buttonId + "-count").text(currentCount + 1);
        // Incrementa el conteo y actualiza el contenido del elemento con el nuevo valor

        $("#" + buttonId).attr("disabled", true);
        // Desactiva el botón en el que se hizo clic para evitar clics múltiples
      },

      error: () => {
        // Función que se ejecuta si la solicitud AJAX no tiene éxito

        $("#" + buttonId).attr("disabled", true);
        // Desactiva el botón en caso de error para evitar clics múltiples
      },
    });
  });
});
