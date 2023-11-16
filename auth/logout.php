<?php
// Requiere los archivos necesarios
require_once "./../includes/session.php"; // session.php contiene la conexión a la base de datos y la inicialización de la sesión

// Si no es una petición POST, redirige al index
if (!isset($_SESSION['user'])) {
  header('Location: ./login.php'); // Si no, redirige al login
  exit(); // Finaliza la ejecución del script
}

// Destruye la sesión y la vuelve a iniciar
session_destroy(); // Destruye la sesión
session_start(); // Inicia la sesión

$_SESSION['logout'] = true; // Establece el token de la sesión
header('Location: ./../index.php'); // Redirige al index
exit(); // Finaliza la ejecución del script
