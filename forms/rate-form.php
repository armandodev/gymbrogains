<?php
// Incluye el archivo de sesión para gestionar la autenticación del usuario
include_once './../includes/session.php';

// Verifica si la solicitud no es de tipo POST
if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
  // Redirige al usuario a la página de ejercicios (exercises.php) si la solicitud no es de tipo POST
  header('Location: ./exercises.php');
  exit();
}

// Obtiene el ID de usuario y otros datos del formulario POST
$user_id = $_SESSION['user']['UserId'];
$id = $_POST['id'];
$rate = $_POST['rate'];
$comment = $_POST['comment'] == '' ? null : $_POST['comment'];

try {
  // Conecta a la base de datos
  $conn = $db->connect();

  // Verifica si el usuario ya ha revisado el ejercicio
  $sql = "SELECT ExerciseID, UserID FROM exerciseratings WHERE ExerciseID = ? AND UserID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $id, $user_id);

  if (!$stmt->execute()) {
    throw new Exception("Error al verificar la reseña", 1);
  }

  $result = $stmt->get_result();
  $stmt->close();

  if ($result->num_rows != 0) {
    // Si el usuario ya ha revisado el ejercicio, muestra un mensaje de error y termina
    throw new Exception("Ya has reseñado este ejercicio", 2);
  }

  // Inserta una nueva reseña si el usuario no ha revisado el ejercicio previamente
  $sql = "INSERT INTO exerciseratings (ExerciseID, UserID, Rating, RatingMessage)
          SELECT ?, ?, ?, ?
          FROM dual
          WHERE NOT EXISTS (
            SELECT *
            FROM exerciseratings
            WHERE ExerciseID = ?
            AND UserID = ?
          )";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iiisii", $id, $user_id, $rate, $comment, $id, $user_id);
  
  if (!$stmt->execute()) {
    throw new Exception("Error al insertar la reseña", 3);
  }

  $stmt->close();

  // Actualiza la calificación promedio del ejercicio
  $sql = "UPDATE exercises
          SET AverageRating = (
            SELECT AVG(Rating)
            FROM exerciseratings
            WHERE ExerciseID = ?
          )
          WHERE ExerciseID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $id, $id);

  if (!$stmt->execute()) {
    throw new Exception("Error al actualizar la calificación", 4);
  }

  $stmt->close();
  $conn->close();

  // Establece una variable de sesión para indicar éxito y redirige al usuario de vuelta a la página del ejercicio
  $_SESSION['success'] = true;
  header('Location: ./../exercise.php?id=' . $id);
  exit();
} catch (Exception $e) {
  $eCode = $e->getCode();
  // Establece variables de sesión para indicar un error y redirige al usuario de vuelta a la página del ejercicio
  $_SESSION['eCode'] = $eCode;
  $_SESSION['error'] = $e->getMessage();
  header('Location: ./../exercise.php?id=' . $id);
  exit();
}
?>
