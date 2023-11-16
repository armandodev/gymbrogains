const regex = [ // Expresiones regulares para validar los campos del formulario
  /^[a-zA-Z]{2,30}$/, // Nombre
  /^[a-zA-Z]{2,30}$/, // Apellido
  /^[a-zA-Z0-9]{6,20}$/, // Nombre de usuario
  /^[a-zA-Z0-9]{6,16}$/, // Contraseña
  /^[a-zA-Z0-9]{10,300}\*$/, // Objetivos
  /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/, // Fecha de nacimiento
  /^[0-1]$/, // Género
];

const validateRegex = (regex, value) => { // Función para validar un valor con una expresión regular
  return regex.test(value); // Valida el valor
};

const errorMessage = (index) => { // Función para obtener el mensaje de error
  const inputName = [ // Nombres de los campos del formulario
    "nombre",
    "apellido",
    "nombre de usuario",
    "contraseña",
    "objetivos",
    "fecha de nacimiento",
    "género",
  ];

  return `El campo ${inputName[index]} es inválido`; // Retorna el mensaje de error
};

const validateForm = (values) => { // Función para validar los valores del formulario
  values.forEach((value) => {
    const regex = regex[value.index]; // Obtiene el regex correspondiente al indice del valor

    if (!validateRegex(regex, value)) { // Si el valor no es válido
      window.scrollTo(0, 0); // Desplaza la página al principio
      return errorMessage(value.index); // Retorna el mensaje de error
    }
  });

  return true; // Retorna verdadero si todos los valores son válidos
};

// Función para mostrar un mensaje de error
function showValidateError(message) {
  const errorContainer = $("#error-container"); // Obtiene el contenedor de error
  const errorMessage = $("#error-message"); // Obtiene el mensaje de error

  errorMessage.html(`${message}`); // Agrega el mensaje de error al contenedor
  errorContainer.css("display", "block"); // Muestra el contenedor de error
}

// Espera a que el documento esté listo (se haya cargado completamente)
$(document).ready(() => {
  const signupForm = $("#signup-form"); // Obtiene el formulario de registro
  const loginForm = $("#login-form"); // Obtiene el formulario de inicio de sesión

  if (loginForm.length) { // Si existe el formulario de inicio de sesión
    loginForm.on("submit", function (event) { // Agrega un evento de envío al formulario de inicio de sesión
      const values = { // Obtiene los valores de los campos del formulario
        3: $("#login-username").val(), // Nombre de usuario
        4: $("#login-password").val() // Contraseña
      };

      const isValid = validateForm(values); // Valida los valores

      if (isValid !== true) { // Si no son válidos
        event.preventDefault(); // Evita que se envíe el formulario
        showValidateError(isValid); // Muestra el mensaje de error
      }
    });
  } else if (signupForm.length) { // Si existe el formulario de registro
    signupForm.on("submit", function (event) { // Agrega un evento de envío al formulario de registro
      const values = [
        $("#signup-name").val(), // Nombre
        $("#signup-last-name").val(), // Apellido
        $("#signup-username").val(), // Nombre de usuario
        $("#signup-password").val(), // Contraseña
        $("#signup-goals").val(), // Objetivos
        $("#signup-birth-date").val(), // Fecha de nacimiento
        $("#signup-gender").val(), // Género
        $("#signup-gender-identity").val() // Identidad de género
      ]

      const isValid = validateForm(values); // Valida los valores
      
      if (isValid !== true) { // Si no son válidos
        event.preventDefault(); // Evita que se envíe el formulario
        showValidateError(isValid); // Muestra el mensaje de error
      }
    });
  }
});
