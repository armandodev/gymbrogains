<?php
// Requiere los archivos necesarios
require_once './../includes/session.php'; // session.php contiene la conexión a la base de datos y la inicialización de la sesión
require_once './../includes/form-validate.php'; // form-validate.php contiene las funciones de validación de formularios

// Si no es una petición POST, redirige al index
if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
  header('Location: ./../index.php'); // Redirige al index
  exit(); // Finaliza la ejecución del script
}

// try catch para capturar errores
try {
  // Realiza la conexión a la base de datos
  $conn = $db->connect();

  // Si no se puede conectar, lanza un error
  if(!$db->validateConnection($conn)) throw new Exception("Error de ejecución", 9);

  // Comprueba si se recibió el nombre
  if(isset($_POST['signup-name'])) $name = $_POST['signup-name'];
  else throw new Exception("Nombre inválido", 1); // Si no, lanza un error

  // Comprueba si se recibió el apellido
  if(isset($_POST['signup-last-name'])) $last_name = $_POST['signup-last-name']; 
  else throw new Exception("Apellido inválido", 2); // Si no, lanza un error

  // Comprueba si se recibió el nombre de usuario
  if(isset($_POST['signup-username'])) $username = $_POST['signup-username'];
  else throw new Exception("Nombre de usuario inválido", 3); // Si no, lanza un error

  // Comprueba si se recibió la contraseña
  if(isset($_POST['signup-password'])) $password = $_POST['signup-password'];
  else throw new Exception("Contraseña inválida", 4); // Si no, lanza un error

  // Comprueba si se recibió la descripción
  if(isset($_POST['signup-goals']) && $_POST['signup-goals'] !== '') $goals = mysqli_real_escape_string($conn, trim($_POST['signup-goals'])); 

  // Comprueba si se recibió la fecha de nacimiento
  if(isset($_POST['signup-birth-date'])) $birth_date = $_POST['signup-birth-date'];
  else throw new Exception("Fecha de nacimiento inválida", 5); // Si no, lanza un error

  // Comprueba si se recibió el sexo
  if(isset($_POST['signup-gender'])) $gender = $_POST['signup-gender'];
  else throw new Exception("Sexo inválido", 6); // Si no, lanza un error

  // Comprueba si se recibió la identidad de género
  if(isset($_POST['signup-gender-identity'])) $gender_identity = mysqli_real_escape_string($conn, trim($_POST['signup-gender-identity']));

  // Elimina los espacios en blanco del principio y el final de las variables
  $name = trim($name);
  $last_name = trim($last_name);
  $username = trim($username);
  $password = trim($password);
  $birth_date = trim($birth_date);
  $gender = trim($gender);

  // Escapa los caracteres especiales de las variables
  $name = mysqli_real_escape_string($conn, $name);
  $last_name = mysqli_real_escape_string($conn, $last_name);
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);
  $birth_date = mysqli_real_escape_string($conn, $birth_date);
  $gender = mysqli_real_escape_string($conn, $gender);

  // Valida los datos recibidos
  $validate = validateSignupForm($name, $last_name, $username, $password, null, $birth_date, $gender, null);

  // Se concatena el nombre y el apellido
  $full_name = "$name $last_name";

  // Si si se recibió la descripción, se valida
  if (isset($goals)) {
      $validate = validateSignupForm($name, $last_name, $username, $password, $goals, $birth_date, $gender, $validate);
  }

  // Si si se recibió la identidad de género, se valida
  if (isset($gender_identity)) {
      $validate = validateSignupForm($name, $last_name, $username, $password, $validate, $birth_date, $gender, $gender_identity);
  }

  // Si la validación devuelve un error, lanza una excepción
  if ($validate instanceof Exception) throw $validate;

  // Prepara la consulta para comprobar si el usuario ya existe
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql); // Prepara la consulta
  $stmt->bind_param("s", $username); // Asigna los parámetros a la consulta

  // Si no se puede ejecutar la consulta, lanza un error
  if(!$stmt->execute()) throw new Exception("Error de ejecución");

  // Obtiene el resultado de la consulta
  $result = $stmt->get_result();
  $stmt->close(); // Cierra la consulta

  // Si el resultado tiene más de 0 filas, lanza un error
  if($result->num_rows > 0) throw new Exception("El usuario ya esta registrado", 7);

  // Genera el salt y la contraseña hasheada
  $salt = bin2hex(openssl_random_pseudo_bytes(16)); // Salt
  $hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT); // Contraseña

  // Formatea la fecha de nacimiento
  $birth_date = date("Y-m-d", strtotime($birth_date));

  // Prepara la consulta para insertar el usuario en la base de datos
  $sql = "INSERT INTO users (Name, Username, Password, Salt, BirthDate, Gender";
  $paramTypes = "sssssi"; // Tipos de los parámetros
  $paramTypesCount = "?, ?, ?, ?, ?, ?"; // Cantidad de parámetros
  $paramValues = [$full_name, $username, $hashedPassword, $salt, $birth_date, $gender]; // Valores de los parámetros

  // Si se recibió la descripción, se añade a la consulta
  if (isset($goals)) {
      $sql .= ", Goals"; // Añade la descripción a la consulta
      $paramTypes .= "s"; // Añade el tipo de la descripción a la consulta
      $paramTypesCount .= ", ?"; // Añade la cantidad de parámetros a la consulta
      $paramValues[] = $goals; // Añade la descripción a los valores de los parámetros
  }

  // Si se recibió la identidad de género, se añade a la consulta
  if (isset($gender_identity)) {
      $sql .= ", GenderIdentity"; // Añade la identidad de género a la consulta
      $paramTypes .= "i"; // Añade el tipo de la identidad de género a la consulta
      $paramTypesCount .= ", ?"; // Añade la cantidad de parámetros a la consulta
      $paramValues[] = $gender_identity; // Añade la identidad de género a los valores de los parámetros
  }

  // Añade el resto de la consulta
  $sql .= ") VALUES ($paramTypesCount)";

  // Prepara la consulta
  $stmt = $conn->prepare($sql);
  $stmt->bind_param($paramTypes, ...$paramValues); // Asigna los parámetros a la consulta

  // Si no se puede ejecutar la consulta, lanza un error
  if(!$stmt->execute()) throw new Exception("Error de ejecución");

  // Cierra la consulta
  $stmt->close();
  $conn->close(); // Cierra la conexión

  // Establece el token de la sesión
  $_SESSION['signup'] = true;
  header('Location: ./../login.php'); // Redirige al login
  exit(); // Finaliza el script
} catch (Exception $e) { // Si se lanza una excepción
  // Obtiene el código de la excepción
  $eCode = $e->getCode();
  $_SESSION['signup'] = false; // Indica que el registro no se ha realizado correctamente
  $_SESSION['eCode'] = $eCode; // Asigna el código de la excepción a la sesión
  header("Location: ./../signup.php"); // Redirige al registro
  exit(); // Finaliza el script
} 
