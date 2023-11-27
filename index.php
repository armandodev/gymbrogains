<?php
require_once __DIR__ . "/includes/session.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio | Gymbrogains</title>

  <link rel="stylesheet" href="./fonts/css/index.css" />
  <link rel="stylesheet" href="./css/normalize.css" />
  <link rel="stylesheet" href="./css/global.css" />
  <?php if (isset($_SESSION["login"]) || isset($_SESSION['logout'])) { ?>
    <link rel="stylesheet" href="./css/modal.css" />
  <?php } ?>
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/index-slider.css" />

  <link rel="icon" href="./favicon.ico" />
</head>

<body>
  <?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
    <div class="modal" id="login-success">
      <p class="modal-text">
        Bienvenido(a) de nuevo
        <span><?php echo $_SESSION['user']['Username'] ?></span>
      </p>
      <a href="./index.php" class="modal-button">Cerrar</a>
    </div>
  <?php
    unset($_SESSION['login']);
    exit();
  } elseif (isset($_SESSION['logout']) && $_SESSION['logout']) { ?>
    <div class="modal" id="logout-success">
      <p class="modal-text">
        Has cerrado sesión
        <span>correctamente.</span>
      </p>
      <a href="./index.php" class="modal-button">Cerrar</a>
    </div>
  <?php
    unset($_SESSION['logout']);
    exit();
  }
  ?>

  <header>
    <div class="header-container">
      <div class="header-logo">
        <a href="./index.php">
          <img src="./images/logo/white.webp" alt="Gymbrogains" />
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
          <!-- <li class="header-nav-link">
            <a href="./calculator.php">
              <span class="material-icons"> calculate </span>
              Calculadora
            </a>
          </li> -->
          <?php
          if (isset($_SESSION["user"])) { ?>
            <li class="header-nav-link">
              <a href="./forum.php">
                <span class="material-icons"> forum </span>
                Foro
              </a>
            </li>
            <li class="header-nav-link">
              <a href="./profile.php">
                <span class="material-icons"> account_circle </span>
                Perfil
              </a>
            </li>
            <?php if ($_SESSION['user']['Role'] == 0) { ?>
              <li class="header-nav-link">
                <a href="./admin/index.php">
                  <span class="material-icons"> admin_panel_settings </span>
                  Administración
                </a>
              </li>
            <?php
            }
          } else { ?>
            <li class="header-nav-link">
              <a href="./login.php">
                <span class="material-icons"> login </span>
                Iniciar sesión
              </a>
            </li>
            <li class="header-nav-link">
              <a href="./signup.php">
                <span class="material-icons"> person_add </span>
                Regístrate
              </a>
            </li>
          <?php } ?>
        </ul>
      </nav>

      <button id="show-menu">
        <span class="material-icons"> menu </span>
      </button>
    </div>
  </header>

  <main>
    <section id="slider-section">
      <div class="slider-container">
        <input type="radio" id="exercises" class="slider-input" name="banner" checked />
        <input type="radio" id="calculator" class="slider-input" name="banner" />
        <input type="radio" id="foro" class="slider-input" name="banner" />
        <div class="slider">
          <div id="exercises-banner" class="banner">
            <div class="banner-inner-wrapper">
              <h1>Ejercicios</h1>
              <p>
                Encuentra tu rutina perfecta: Explora nuestra librería de
                ejercicios para alcanzar tus metas fitness.
              </p>
              <div class="line"></div>
              <div class="learn-more-button">
                <a href="./exercises.php">Mas detalles</a>
              </div>
            </div>
          </div>
          <div id="calculator-banner" class="banner">
            <div class="banner-inner-wrapper">
              <h1>Macros</h1>
              <p>
                Calcula tus macros: Optimiza tu dieta con nuestra calculadora
                de macro-nutrientes.
              </p>
              <div class="line"></div>
              <div class="learn-more-button">
                <a href="./calculator.php">Mas detalles</a>
              </div>
            </div>
          </div>
          <div id="foro-banner" class="banner">
            <div class="banner-inner-wrapper">
              <h1>Foro</h1>
              <p>
                Conéctate y comparte: Únete a nuestra comunidad en el foro
                fitness.
              </p>
              <div class="line"></div>
              <div class="learn-more-button">
                <?php if (isset($_SESSION['user'])) { ?>
                  <a href="./forum.php">Mas detalles</a>
                <?php } else { ?>
                  <a href="./login.php">Iniciar sesión</a>
                  <a href="./signup.php">Regístrate</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <nav>
          <div class="controls">
            <label for="exercises">
              <span class="progressbar">
                <span class="progressbar-fill"></span>
              </span>
              <span>1</span> Ejercicios
            </label>
            <label for="calculator">
              <span class="progressbar">
                <span class="progressbar-fill"></span>
              </span>
              <span>2</span> Calculadora
            </label>
            <label for="foro">
              <span class="progressbar">
                <span class="progressbar-fill"></span>
              </span>
              <span>3</span> Foro
            </label>
          </div>
        </nav>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-bottom">
      <p>&copy; 2023 Gymbrogains - Todos los derechos reservados</p>
    </div>
  </footer>

  <script src="./js/jquery/jquery-3.7.1.min.js"></script>
  <script src="./js/header.js"></script>
  <script src="./js/index-slider.js"></script>
</body>

</html>