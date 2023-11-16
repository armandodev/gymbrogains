<?php
require_once "./../includes/session.php";

if (!$isAdmin && !$isLogged) {
  header("location:../index.php");
  exit();
}

// Aquí van a trabajar, harán la pagina de inicio de admin, y la pagina de administración de usuarios dentro de admin/users.php y admin/index.php. Principalmente trabajaran con la estructura HTML de ambas páginas, y con el manejo dinámico desde la base de datos. Les dare el acceso en breve

/* Secciones
  * Header
    * Logo
    * Navbar <- El nav bar lo encuentran en el index de la parte publica, lo pueden copiar y pegar
    * Botón para mostrar el menu
  * Main
    * Banner con el nombre de la pagina
    * Sección de usuarios
      * Tabla con los 5 usuarios más recientes y un botón para ver todos los usuarios
    * Sección de ejercicios
      * Tabla con los 5 ejercicios más recientes y un botón para ver todos los ejercicios
    * Sección de foro
      * Tabla con los 5 temas más recientes y un botón para ver todos los temas
  * Footer
    * Leyenda de derechos de autor
*/
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración | Gymbrogains</title> <!-- Aquí va el titulo de la pagina -->

</head>

<body>
  <!-- Dentro del header ira el logo, la barra y el botón, esto esta en el index solo copia y pega -->
  <header>
    <div class="header-container">
      <div class="header-logo">
        <a href="./index.php">
          <img src="./images/logo/white.webp" alt="Gymbrogains" />
        </a>
      </div>
      <nav class="header-nav">
        <div id="menu-hide-bg"></div>
        <ul class="header-nav-links" id="menu">
          <li class="header-nav-link active">
            <a href="./index.php">Inicio</a>
          </li>
          <li class="header-nav-link">
            <a href="./exercises.php">Ejercicios</a>
          </li>
          <li class="header-nav-link">
            <a href="./calculator.php">Calculadora</a>
          </li>
          <?php
          if (isset($_SESSION["user"])) { ?>
            <li class="header-nav-link">
              <a href="./forum.php">Foro</a>
            </li>
            <li class="header-nav-link">
              <a href="./profile.php">
                <span class="material-icons"> account_circle </span>
                <span id="profile-nav"></span>
              </a>
            </li>
            <?php if ($_SESSION['user']['Role'] == 0) { ?>
              <li class="header-nav-link">
                <a href="./admin/index.php">
                  <span class="material-icons"> admin_panel_settings </span>
                  <span id="admin-nav"></span>
                </a>
              </li>
            <?php
            }
          } else { ?>
            <li class="header-nav-link">
              <a href="./login.php">
                <span class="material-icons"> login </span>
                <span id="login-nav"></span>
              </a>
            </li>
            <li class="header-nav-link">
              <a href="./signup.php">
                <span class="material-icons"> person_add </span>
                <span id="signup-nav"></span>
              </a>
            </li>
          <?php } ?>
        </ul>
      </nav>

      <button id="menu-button">
        <span class="material-icons"> menu </span>
      </button>
    </div>
  </header>
  <!-- Dentro del main van secciones(section) y dentro de las secciones van artículos(article) -->
  <main>
    <section id="banner">
      <article>
        <h3>Administración</h3>
        <p>Gymbrogains</p>
      </article>
    </section>
    <section id="users">
      <ul id="users-list">

        <li class="">
          <div class="">

            <h2 class="">
              <?php echo $users['UserName']; ?>
            </h2>
          </div>
          <div class="">
            <p class="">
              <span class="material-icons"> star </span>
              <span class="exercise-rating-value"><?php echo $exercise['AverageRating']; ?></span>
            </p>
            <a href="./exercise.php?id=<?php echo $exercise['ExerciseID']; ?>" class="">Ver usuarios</a>
          </div>
        </li>
      </ul>

    </section>
    <section id="exercises">
      <ul id="exercises-list">
        <?php foreach ($exercises as $exercise) { ?>
          <li class="exercise">
            <div class="exercise-category-name">
              <img src="./images/exercises/icons/<?php echo $exercise['Category']; ?>.webp" alt="<?php echo $exercise['ExerciseName']; ?>, <?php echo $exercise['Category'] ?>" />
              <h2 class="exercise-name">
                <?php echo $exercise['ExerciseName']; ?>
              </h2>
            </div>
            <div class="exercise-info">
              <p class="exercise-rating">
                <span class="material-icons"> star </span>
                <span class="exercise-rating-value"><?php echo $exercise['AverageRating']; ?></span>
              </p>
              <a href="./exercise.php?id=<?php echo $exercise['ExerciseID']; ?>" class="exercise-button">Ver ejercicio</a>
            </div>
          </li>
      </ul>

    <?php } ?>
    </section>
    <section id="forum">
      <ul id="forum-list">

        <li class="">
          <div class="">

            <h2 class="">
              <?php echo $forum['Forum']; ?>
            </h2>
          </div>
          <div class="">
            <p class="">
              <span class="material-icons"> star </span>
              <span class="exercise-rating-value"><?php echo $exercise['AverageRating']; ?></span>
            </p>
            <a href="./exercise.php?id=<?php echo $exercise['ExerciseID']; ?>" class="">Ver temas</a>
          </div>
        </li>
      </ul>
    </section>
  </main>
  <!-- El footer nomas es una cosa no mamen, si mamo-->
  <footer>
    <div class="footer-bottom">
      <p>&copy; 2023 Gymbrogains - Todos los derechos reservados</p>
    </div>
  </footer>
</body>

</html>