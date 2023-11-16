$(document).ready(() => {
  // Espera a que el documento esté listo

  function showMenu(menu, menuHideBg) {
    $(menu).css("display", "flex"); // Muestra el menú como flex
    $(menuHideBg).css("display", "block"); // Muestra el fondo del menú
    setTimeout(() => {
      $(menu).css("right", "0"); // Desliza el menú a la posición derecha cero
      $(menuHideBg).css("opacity", "1"); // Hace el fondo del menú completamente visible
    }, 100); // Con un retraso de 100 ms
  }

  function hideMenu(menu, menuHideBg) {
    $(menu).css("right", "-80%"); // Oculta el menú moviéndolo a la derecha
    $(menuHideBg).css("opacity", "0"); // Hace el fondo del menú completamente transparente
    setTimeout(() => {
      $(menu).css("display", "none"); // Oculta completamente el menú
      $(menuHideBg).css("display", "none"); // Oculta el fondo del menú
    }, 500); // Con un retraso de 500 ms
  }

  function responsiveMenu() {
    const menu = $("#menu"); // Obtiene el elemento con id "menu"
    const menuButton = $("#menu-button"); // Obtiene el botón del menú
    const menuHideBg = $("#menu-hide-bg"); // Obtiene el fondo del menú
    const profileNav = $("#profile-nav"); // Obtiene un elemento de navegación
    const adminNav = $("#admin-nav"); // Obtiene otro elemento de navegación
    const loginNav = $("#login-nav"); // Obtiene un elemento de navegación
    const signupNav = $("#signup-nav"); // Obtiene un elemento de navegación
    const forumForm = $("#forum-form"); // Obtiene un formulario

    if ($(window).width() <= 768) {
      menu.css("display", "none"); // Muestra el menú como flex
      // Si el ancho de la ventana es menor o igual a 768 píxeles
      menuButton.on("click", () => showMenu(menu, menuHideBg)); // Asocia el clic en el botón con la función showMenu
      menuHideBg.on("click", () => hideMenu(menu, menuHideBg)); // Asocia el clic en el fondo con la función hideMenu
      if (loginNav && signupNav) {
        loginNav.html("Ingresar"); // Cambia el contenido del elemento de navegación a "Ingresar"
        signupNav.html("Registrarse"); // Cambia el contenido del elemento de navegación a "Registrarse"
      }
      if (profileNav && adminNav) {
        profileNav.html("Perfil"); // Cambia el contenido del elemento de navegación a "Perfil"
        adminNav.html("Administración"); // Cambia el contenido del elemento de navegación a "Administración"
      }
      if (forumForm) {
        forumForm.html("Publicar"); // Cambia el contenido del formulario a "Publicar"
      }
    } else {
      const menu = $("#menu"); // Obtiene el elemento con id "menu" nuevamente
      const menuHideBg = $("#menu-hide-bg"); // Obtiene el fondo del menú nuevamente
      menu.css("display", "flex"); // Muestra el menú como flex
      menuHideBg.css("display", "none"); // Oculta el fondo del menú
      if (loginNav && signupNav) {
        loginNav.html(""); // Borra el contenido del elemento de navegación
        signupNav.html(""); // Borra el contenido del elemento de navegación
      }
      if (profileNav && adminNav) {
        profileNav.html(""); // Borra el contenido del elemento de navegación
        adminNav.html(""); // Borra el contenido del elemento de navegación
      }
      if (forumForm) {
        forumForm.html(""); // Borra el contenido del formulario
      }
    }
  }

  responsiveMenu(); // Llama a la función responsiveMenu para configurar inicialmente el menú
  $(window).on("resize", () => responsiveMenu()); // Asocia el evento de redimensionamiento de la ventana con la función responsiveMenu
});
