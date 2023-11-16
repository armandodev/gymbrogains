<?php
// Requiere obligatoriamente el archivo session.php
require_once __DIR__ . "/../includes/session.php";

// try catch para capturar errores
try {
  // Si no es una petición POST, lanza un error
  if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    throw new Exception("Method not allowed", 405);
  }

  // Recupera los datos recibidos y el id del usuario de la sesión
  $buttonId = $_POST["buttonId"];
  $userID = $_SESSION["user"]["UserId"];

  // Realiza la conexión a la base de datos
  $conn = $db->connect();

  // Si no se puede conectar, lanza un error
  if ($conn->connect_error) {
    throw new Exception("Internal server error", 500);
  }

  // Prepara la consulta para comprobar si el usuario ya ha dado like a ese post
  $sql = "SELECT * FROM forumlikes WHERE TopicID = ? AND UserID = ?";
  $stmt = $conn->prepare($sql);

  // Si no se puede preparar la consulta, lanza un error
  if (!$stmt) {
    throw new Exception("Internal server error", 500);
  }

  // Asigna los parámetros a la consulta
  $stmt->bind_param("ii", $buttonId, $userID);

  // Si no se puede ejecutar la consulta, lanza un error
  if (!$stmt->execute()) {
    throw new Exception("Internal server error", 500);
  }

  // Obtiene el resultado de la consulta
  $result = $stmt->get_result();
  $stmt->close(); // Cierra la consulta

  // Si el resultado tiene más de 0 filas, lanza un error
  if ($result->num_rows > 0) {
    throw new Exception("Ya has dado like a este post", 400);
  }

  // Prepara la consulta para insertar el like en la tabla forumlikes
  $sql = "INSERT INTO forumlikes (TopicID, UserID) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);

  // Si no se puede preparar la consulta, lanza un error
  if (!$stmt) {
    throw new Exception("Internal server error", 500);
  }

  // Asigna los parámetros a la consulta
  $stmt->bind_param("ii", $buttonId, $userID);

  // Si no se puede ejecutar la consulta, lanza un error
  if (!$stmt->execute()) {
    throw new Exception("Internal server error", 500);
  }

  // Cierra la consulta
  $stmt->close();

  // Prepara la consulta para incrementar el contador de likes en la tabla forum
  $sql = "UPDATE forum SET Likes = Likes + 1 WHERE TopicID = ? AND userID = ?";
  $stmt = $conn->prepare($sql);

  // Si no se puede preparar la consulta, lanza un error
  if (!$stmt) {
    throw new Exception("Internal server error", 500);
  }

  // Asigna los parámetros a la consulta
  $stmt->bind_param("ii", $buttonId, $userID);

  // Si no se puede ejecutar la consulta, lanza un error  
  if (!$stmt->execute()) {
    throw new Exception("Internal server error", 500);
  }

  // Cierra la consulta
  $stmt->close();
  $conn->close(); // Cierra la conexión

  // Devuelve un código de estado 200 (OK)
  http_response_code(200);
} catch (Exception $e) { // Si se ha lanzado alguna excepción
  // Devuelve un código de estado 500 (Internal Server Error), 400 (Bad Request) o 405 (Method not allowed)
  http_response_code($e->getCode());
}
