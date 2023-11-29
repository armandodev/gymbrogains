<!-- Subida de ejercicios junto con la imagen
    Nombre ejercicio descripción y categoría y imagen
-->
<?php
require_once "./../includes/session.php";
$conn = $db->connect();

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios | Gymbrogains</title>

  <link rel="stylesheet" href="./../fonts/css/index.css">
  <link rel="stylesheet" href="./../css/normalize.css">
  <link rel="stylesheet" href="./../css/global.css">
  <link rel="stylesheet" href="./../css/header.css">
  <link rel="stylesheet" href="./../css/footer.css">
  <link rel="stylesheet" href="./css/exercises.css">

  <link rel="shortcut icon" href="./../favicon.ico" type="image/x-icon">
</head>

<body>
  <dialog class="modal" id="modal-form">
    <form action="" class="" method="post" id="insert-exercise" class="form">
      <button class="close-modal" id="close-modal">
        <span class="material-icons"> close </span>
      </button>

      <fieldset class="fieldset">
        <legend class="legend">Información</legend>

        <label class="form-label">
          Nombre del ejercicio
          <input type="text" class="form-input" name="name-exercises">
        </label>

        <label class="form-label">
          Descripción
          <input type="text" class="form-input" name="description">
        </label>

        <label class="form-label">
          Categoría
          <select class="select-category form-select" name="category">
            <option value="Gimnasio">Gimnasio</option>
            <option value="Calistenia">Calistenia</option>
          </select>
        </label>
      </fieldset>

      <fieldset class="fieldset">
        <legend class="legend">
          Multimedia
        </legend>

        <label class="form-label">
          Imagen
          <input type="file" class="form-input-file" name="image">
        </label>
        <label class="form-label">
          <input type="submit" class="form-input">
        </label>
      </fieldset>
    </form>
  </dialog>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreEjercicio = $_POST['name-exercises'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $image = $_FILES['image'];
    $targetDir = "./../images/exercises/";
    // procesa los datos aquí
  }
  $sql = "INSERT INTO exercises (exerciesName, ExerciseDescription, category) VALUES ('$nombreEjercicio', '$description', '$category')";

  // Ejecuta la consulta
  if (mysqli_query($db, $sql)) {
    echo "Nuevo registro creado con éxito";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
  }

  // Cierra la conexión
  mysqli_close($db);

  ?>
  ?>
  <header>
    <div class="header-container">
      <div class="header-logo">
        <a href="./../index.php">
          <img src="./../images/logo/white.webp" alt="Gymbrogains" />
        </a>
      </div>
      <nav class="header-nav">
        <div id="hide-menu-bg"></div>
        <ul class="header-nav-links" id="menu">
          <li class="header-nav-link">
            <a href="./index.php">
              <span class="material-icons"> home </span>
              Inicio
            </a>
          </li>
          <li class="header-nav-link active">
            <a href="./exercises.php">
              <span class="material-icons"> fitness_center </span>
              Ejercicios
            </a>
          </li>
          <li class="header-nav-link">
            <a href="./forum.php">
              <span class="material-icons"> forum </span>
              Foro
            </a>
          </li>
          <li class="header-nav-link">
            <a href="./users.php">
              <span class="material-icons"> group </span>
              Usuarios
            </a>
          </li>
          <li class="header-nav-link">
            <a href="./../index.php">
              <span class="material-icons"> public </span>
              Publica
            </a>
          </li>
          <li class="header-nav-link">
            <a href="./" id="add-exercise">
              <span class="material-icons"> add </span>
              Subir un ejercicio
            </a>
          </li>
        </ul>
      </nav>

      <button id="show-menu">
        <span class="material-icons"> menu </span>
      </button>
    </div>
  </header>

  <main id="main">
    <div class="content-wrapper">

    </div>
  </main>

  <script src="./../js/jquery/jquery-3.7.1.min.js"></script>
  <script src="./../js/header.js"></script>
  <script src="./js/modal.js"></script>
</body>

</html>