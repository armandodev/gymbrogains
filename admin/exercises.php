<!-- Subida de ejercicios junto con la imagen
    Nombre ejercicio descripción y categoría y imagen
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios | Gymbrogains</title>

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
        </ul>
      </nav>

      <button id="show-menu">
        <span class="material-icons"> menu </span>
      </button>
    </div>
  </header>

  <main id="main">
    <div class="content-wrapper">
      <form action="./" id="insert-exercise" class="form">
        <fieldset class="fieldset">
          <legend class="legend">Información</legend>

          <label class="form-label">
            Nombre del ejercicio
            <input type="text" class="exercise-input">
          </label>

          <label class="form-label">
            Descripción
            <input type="text" class="form-input">
          </label>

          <label class="form-label">
            Categoría
            <select class="select-category form-select">
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
            <input type="file" class="form-input">
          </label>
        </fieldset>
      </form>
    </div>
  </main>

  <script src="./../js/jquery/jquery-3.7.1.min.js"></script>
  <script src="./../js/header.js"></script>
</body>

</html>