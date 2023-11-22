<!-- Actualización, eliminación y creación de usuarios a través de la parte de administración -->
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
  <meta name="viewport" content="width=bro, initial-scale=1.0">
  <title>Usuarios | Gymbrogains</title>

  <link rel="stylesheet" href="./../fonts/css/index.css">
  <link rel="stylesheet" href="./../css/normalize.css">
  <link rel="stylesheet" href="./../css/global.css">
  <link rel="stylesheet" href="./../css/header.css">
  <link rel="stylesheet" href="./../css/footer.css">
</head>

<body>
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
          <li class="header-nav-link">
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
          <li class="header-nav-link active">
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
        </ul>
      </nav>

      <button id="show-menu">
        <span class="material-icons"> menu </span>
      </button>
    </div>
  </header>

  <!-- Mostrar con un lazy load o con paginación cualquiera de la que quieran donde con un foreach recorran todo el array recuperado de usuarios -->

  <main id="main">
    <section id="users">

    </section>
  </main>

  <script src="./../js/jquery/jquery-3.7.1.min.js"></script>
  <script src="./../js/header.js"></script>

</body>

</html>