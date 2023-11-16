<?php
require_once __DIR__ . "/includes/session.php";

$results_per_page = 5;

try {
  $conn = $db->connect();
  $sql = "SELECT COUNT(*) as total FROM exercises";
  $stmt = $conn->prepare($sql);
  if (!$stmt->execute()) {
    throw new Exception("Ha ocurrido un error al cargar los ejercicios...");
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();
  $total_results = $row['total'];
  $total_pages = ceil($total_results / $results_per_page);
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($page - 1) * $results_per_page;
  $sql = "SELECT * FROM exercises ORDER BY AverageRating DESC LIMIT $offset, $results_per_page";
  $stmt = $conn->prepare($sql);
  if (!$stmt->execute()) {
    throw new Exception("Ha ocurrido un error al cargar los ejercicios...");
  }
  $result = $stmt->get_result();
  $stmt->close();
  if (!$result->num_rows > 0) {
    throw new Exception("No se han encontrado ejercicios...");
  }
  $exercises = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
  $error_message = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ejercicios | Gymbrogains</title>

    <link rel="stylesheet" href="./fonts/css/index.css" />
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/exercises-list.css" />

    <link rel="icon" href="./favicon.ico" />
  </head>

  <body>
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
            <li class="header-nav-link">
              <a href="./index.php">Inicio</a>
            </li>
            <li class="header-nav-link active">
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

    <main>
      <section id="exercises-list-section">
        <?php if (!isset($error_message)) { ?>
        <ul id="exercises-list">
          <?php foreach ($exercises as $exercise) { ?>
          <li class="exercise">
            <div class="exercise-category-name">
              <img
                src="./images/exercises/icons/<?php echo $exercise['Category']; ?>.webp"
                alt="<?php echo $exercise['ExerciseName']; ?>, <?php echo $exercise['Category'] ?>"
              />
              <h2 class="exercise-name">
                <?php echo $exercise['ExerciseName']; ?>
              </h2>
            </div>
            <div class="exercise-info">
              <p class="exercise-rating">
                <span class="material-icons"> star </span>
                <span class="exercise-rating-value"
                  ><?php echo $exercise['AverageRating']; ?></span
                >
              </p>
              <a
                href="./exercise.php?id=<?php echo $exercise['ExerciseID']; ?>"
                class="exercise-button"
                >Ver ejercicio</a
              >
            </div>
          </li>
        </ul>

        <?php } ?>
        <?php } else { ?>
        <div class="error-message-container">
          <p class="error-message"><?php echo $error_message; ?></p>
        </div>
        <?php } ?>
      </section>
      <div class="pagination">
        <?php
      $i = 1;
      do { ?>
        <a href="exercises.php?page=<?php echo $i; ?>" class="page-link"
          ><?php echo $i; ?></a
        >
        <?php
        $i++;
      } while ($i <= $total_pages) ?>
      </div>
    </main>

    <footer>
      <div class="footer-bottom">
        <p>&copy; 2023 Gymbrogains - Todos los derechos reservados</p>
      </div>
    </footer>

    <script src="./js/jquery/jquery-3.7.1.min.js"></script>
    <script src="./js/header.js"></script>
    <script src="./js/pagination.js"></script>
  </body>
</html>
