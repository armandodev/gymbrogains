<?php
require_once "./../includes/session.php";

if (!$isAdmin || $_SERVER["REQUEST_METHOD"] != "POST") {
  header("Location: ./../index.php");
  exit();
}

try {
  $conn = $db->connect();

  $sql = "INSERT INTO exercises (ExerciseName, ExerciseDescription, category) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $_POST["name-exercises"], $_POST["description"], $_POST["category"]);

  $stmt->execute();

  if ($stmt->error) {
    throw new Exception($stmt->error);
  }

  $stmt->close();

  echo "Ejercicio agregado con éxito";
} catch (Exception $e) {
  echo $e->getMessage();
}
