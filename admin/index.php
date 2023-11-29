  <?php
  require_once "./../includes/session.php";

  $conn = $db->connect();

  if (!$isAdmin) {
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
    <link rel="stylesheet" href="./../css/index-slider.css">
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
                  Crea, edita y elimina: Gestiona los ejercicios de la base de
                  datos.
                </p>
                <div class="line"></div>
                <div class="learn-more-button">
                  <a href="./exercises.php">Mas detalles</a>
                </div>
              </div>
            </div>
            <div id="calculator-banner" class="banner">
              <div class="banner-inner-wrapper">
                <h1>Usuarios</h1>
                <p>
                  Edita y elimina: Gestiona los usuarios de la base de
                  datos.
                </p>
                <div class="line"></div>
                <div class="learn-more-button">
                  <a href="./users.php">Mas detalles</a>
                </div>
              </div>
            </div>
            <div id="foro-banner" class="banner">
              <div class="banner-inner-wrapper">
                <h1>Foro</h1>
                <p>
                  Edita y elimina: Gestiona los hilos y comentarios de la
                  base de datos.
                </p>
                <div class="line"></div>
                <div class="learn-more-button">
                  <a href="./forum.php">Mas detalles</a>
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
                <span>2</span> Usuarios
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
        <p>&copy; 2023 Gymbrogains</p>
      </div>
    </footer>

    <script src="./../js/jquery/jquery-3.7.1.min.js"></script>
    <script src="./../js/header.js"></script>
    <script src="./../js/index-slider.js"></script>
  </body>

  </html>