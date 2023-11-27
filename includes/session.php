<?php
//Valida primero si la url es igual a la ruta del mismo archivo y en caso de ser asi envía al usuario al index
if (basename($_SERVER["PHP_SELF"]) == "session.php") {
  header("location:../index.php");
  exit();
}

//Requiere el archivo de la base de datos
require_once __DIR__ . "/database.php";

//Inicia la sesión
session_start();

//Crea una instancia de la clase Database
$db = new Database();

if (isset($_SESSION['user']) && isset($_SESSION['user']['UserId'])) {
  try {
    $db->getUserById();
  } catch (Exception $e) {
    header("location:../index.php?session=expired");
    exit();
  }
} elseif (isset($_SESSION['user']) && !isset($_SESSION['user']['UserId'])) {
  header("location:../index.php?session=expired");
  exit();
}

$isLogged = isset($_SESSION['user']) && isset($_SESSION['user']['UserId']);
$isAdmin = $isLogged && $_SESSION['user']['Role'] == 0;
