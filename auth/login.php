<?php
// Requiere los archivos necesarios
require_once './../includes/session.php'; // session.php contiene la conexión a la base de datos y la inicialización de la sesión
require_once './../includes/form-validate.php'; // form-validate.php contiene las funciones de validación de formularios

// Si no es una petición POST, redirige al index
if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
  header('Location: ./../index.php');
  exit();
}

// try catch para capturar errores
try {
  // Realiza la conexión a la base de datos
  $conn = $db->connect();

  // Si no se puede conectar, lanza un error
  if (!$db->validateConnection($conn)) throw new Exception("Error de ejecución");

  // Comprueba si se recibió el nombre de usuario
  if (isset($_POST['login-username'])) $username = $_POST['login-username'];
  else throw new Exception("Nombre de usuario inválido", 3); // Si no, lanza un error
  // Comprueba si se recibió la contraseña
  if (isset($_POST['login-password'])) $password = $_POST['login-password'];
  else throw new Exception("Contraseña inválida", 4); // Si no, lanza un error

  // Elimina los espacios en blanco del principio y el final de las variables
  $username = trim($username);
  $password = trim($password);

  // Escapa los caracteres especiales de las variables
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  // Valida los datos recibidos
  $validate = validateLoginForm($username, $password);

  // Si la validación devuelve un error, lanza una excepción
  if ($validate instanceof Exception) throw $validate;

  // Prepara la consulta para obtener el salt y la contraseña del usuario
  $sql = "SELECT Salt, Password FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql); // Prepara la consulta
  $stmt->bind_param("s", $username); // Asigna los parámetros a la consulta

  // Si no se puede ejecutar la consulta, lanza un error
  if (!$stmt->execute()) throw new Exception("Error de ejecución");

  // Obtiene el resultado de la consulta
  $result = $stmt->get_result();
  $stmt->close(); // Cierra la consulta

  // Si el resultado tiene 0 filas, lanza un error
  if ($result->num_rows === 0) throw new Exception("Usuario no encontrado", 7);

  // Obtiene el salt y la contraseña del usuario
  $row = $result->fetch_assoc();
  $salt = $row['Salt']; // Salt
  $hashedPassword = $row['Password']; // Contraseña

  // Comprueba si la contraseña es correcta
  if (!password_verify($password . $salt, $hashedPassword)) throw new Exception("Contraseña incorrecta", 8);

  // Prepara la consulta para obtener los datos del usuario
  $sql = "SELECT UserId, Name, Username, BirthDate, Goals, Role, Gender, GenderIdentity FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql); // Prepara la consulta
  $stmt->bind_param("s", $username); // Asigna los parámetros a la consulta

  // Si no se puede ejecutar la consulta, lanza un error
  if (!$stmt->execute()) throw new Exception("Error de ejecución");

  // Obtiene el resultado de la consulta
  $result = $stmt->get_result();
  $stmt->close(); // Cierra la consulta

  // Hace un fetch de los datos del usuario
  $row = $result->fetch_assoc();
  $_SESSION['user'] = $row; // Asigna los datos del usuario a la sesión

  // Crea el token de la sesión
  $_SESSION['login'] = true; // Indica que el login se ha realizado correctamente
  header('Location: ./../index.php'); // Redirige al index
  exit(); // Finaliza el script
} catch (Exception $e) { // Si se lanza una excepción
  // Obtiene el código de la excepción
  $eCode = $e->getCode();

  // Crea el token de la sesión
  $_SESSION['login'] = false; // Indica que el login no se ha realizado correctamente
  $_SESSION['eCode'] = $eCode; // Asigna el código de la excepción a la sesión
  header("Location: ./../login.php"); // Redirige al login
  exit(); // Finaliza el script
}
