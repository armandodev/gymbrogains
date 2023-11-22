<?php
require_once "./../includes/session.php";

if (!$isAdmin && !$isLogged) {
  header("location:../index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración | Gymbrogains</title>

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
          <li class="header-nav-link active">
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
          <li class="header-nav-link">
            <a href="./users.php">
              <span class="material-icons"> group </span>
              Usuarios
            </a>
          </li>
          <li class="header-nav-link">
            <a href="./../includes/logout.php">
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

  <footer>
    <div class="footer-bottom">
      <p>&copy; 2023 Gymbrogains</p>
    </div>
  </footer>

  <script src="./../js/jquery/jquery-3.7.1.min.js"></script>
  <script src="./../js/header.js"></script>
</body>

</html>