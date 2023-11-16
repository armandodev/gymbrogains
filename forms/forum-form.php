<?php
// Incluye el archivo de sesión para gestionar la autenticación del usuario
require_once "./../includes/session.php";

// Verifica si el usuario no ha iniciado sesión
if (!isset($_SESSION["user"])) {
  // Redirige al usuario a la página de inicio de sesión (login.php) si no ha iniciado sesión
  header("Location: ./login.php");
  exit();
}

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtiene el título del tema y el contenido del formulario POST
  $topic_title = $_POST["topic-title"];
  $content = $_POST["content"];

  // Conecta a la base de datos
  $conn = $db->connect();

  // Prepara una consulta SQL para insertar un nuevo tema en la tabla "forum"
  $sql = "INSERT INTO forum (UserID, TopicTitle, MessageContent) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);

  // Vincula los valores de los parámetros a la consulta preparada
  $stmt->bind_param("iss", $_SESSION["user"]["UserId"], $topic_title, $content);

  // Ejecuta la consulta
  $stmt->execute();
  $stmt->close();

  // Cierra la conexión a la base de datos
  $conn->close();

  // Redirige al usuario a la página del foro (forum.php) después de crear el tema
  header("Location: ./../forum.php");
  exit();
} else {
  // Si la solicitud no es de tipo POST, redirige al usuario de vuelta a la página del foro (forum.php)
  header("Location: ./../forum.php");
  exit();
}
?>
