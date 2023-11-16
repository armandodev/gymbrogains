// PREGUNTAS:
//TODO setTimeout(() => { SE CAMBIA ? COMO? PARA QUExd SIRVE Simon, se pasa igual
/* Explicación del setTimeout en JS, que es y para que sirve
El setTimeout() realiza una llamada a una función después de que transcurre un tiempo determinado.
recibe dos parámetros, el primero es la función que se va a ejecutar y el segundo es el tiempo en ms que se va a esperar para ejecutar la función.

() => {} es una función anónima, es decir, una función que no tiene nombre. En este caso, la función anónima no recibe ningún parámetro y hará todo lo que este en los corchetes.
*/

document.addEventListener("DOMContentLoaded", (event) => {
  // Espera a que el documento esté listo

  // Funciones
  const showMenu = (menu, menuHideBg) => {
    menu.style.display = "flex"; // Muestra el menú como flex
    menuHideBg.style.display = "block"; // Muestra el fondo del menú
    setTimeout(() => {}, 500);
  };
});
//el ñiño huele a trujoboo
