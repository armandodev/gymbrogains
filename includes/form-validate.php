<?php
// Función para validar un nombre
function validateName($name) {
  $regex = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/u';

  if (preg_match($regex, $name)) {
    return true; // El nombre es válido
  } else {
    return false; // El nombre no cumple con el formato
  }
}

// Función para validar un apellido
function validateLastName($last_name) {
  $regex = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,30}$/u';

  if (preg_match($regex, $last_name)) {
    return true; // El apellido es válido
  } else {
    return false; // El apellido no cumple con el formato
  }
}

// Función para validar un nombre de usuario
function validateUsername($username) {
  $regex = '/^[a-zA-Z0-9]{6,20}$/';

  if (preg_match($regex, $username)) {
    return true; // El nombre de usuario es válido
  } else {
    return false; // El nombre de usuario no cumple con el formato
  }
}

// Función para validar una contraseña
function validatePassword($password) {
  $regex = '/^[a-zA-Z0-9]{6,16}$/';

  if (preg_match($regex, $password)) {
    return true; // La contraseña es válida
  } else {
    return false; // La contraseña no cumple con el formato
  }
}

// Función para validar el género
function validateGender($gender) {
  $regex = '/^[0-1]$/';

  if (preg_match($regex, $gender)) {
    return true; // El valor de género es válido
  } else {
    return false; // El valor de género no es válido
  }
}

// Función para validar un formulario de registro
function validateSignupForm($name, $last_name, $username, $password, $goals, $birth_date, $gender, $gender_identify) {
  try {
    if (!validateName($name)) {
      throw new Exception('Nombre inválido', 1);
    }
    if (!validateLastName($last_name)) {
      throw new Exception('Apellido inválido', 2);
    }
    if (!validateUsername($username)) {
      throw new Exception('Nombre de usuario inválido', 3);
    }
    if (!validatePassword($password)) {
      throw new Exception('Contraseña inválida', 4);
    }
    if (!validateGender($gender)) {
      throw new Exception('Sexo inválido', 5);
    }
    if ($gender_identify !== null && !validateGender($gender_identify)) {
      throw new Exception('Género identificado inválido', 6);
    }

    return true; // Todos los campos del formulario son válidos
  } catch (Exception $e) {
    return $e; // Se lanza una excepción con el mensaje de error correspondiente
  }
}

// Función para validar un formulario de inicio de sesión
function validateLoginForm($username, $password) {
  try {
    if (!validateUsername($username)) {
      throw new Exception('Nombre de usuario inválido', 3);
    }
    if (!validatePassword($password)) {
      throw new Exception('Contraseña inválida', 4);
    }

    return true; // Ambos campos del formulario de inicio de sesión son válidos
  } catch (Exception $e) {
    return $e; // Se lanza una excepción con el mensaje de error correspondiente
  }
}
