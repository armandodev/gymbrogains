<?php
require_once __DIR__ . "/includes/session.php";

if (isset($_SESSION["user"])) {
  $userID = $_SESSION["user"]["UserId"];
  $conn = $db->connect();

  $sql = "SELECT Weight, Height, Goal, ActivityLevel
          FROM userprogress
          JOIN macronutrients ON userprogress.UserID = macronutrients.UserID
          WHERE userprogress.UserID = ?
          ORDER BY userprogress.PublicationDate DESC
          LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userID);

  if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $stmt->close();

      $weight = $row["Weight"];
      $height = $row["Height"];
      $goal = $row["Goal"];
      $activityLevel = $row["ActivityLevel"];
      $birthDate = new DateTime($_SESSION["user"]["BirthDate"]);
      $currentDate = new DateTime();
      $age = $birthDate->diff($currentDate)->y;

      if ($birthDate->format('md') > $currentDate->format('md')) {
        $age--;
      }

      $gender = $_SESSION['user']['Gender'];
    } else {
      $stmt->close();
    }
  } else {
    $stmt->close();
  }
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calculadora | Gymbrogains</title>

    <link rel="stylesheet" href="./fonts/css/index.css" />
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/calculator-form.css" />

    <link rel="icon" href="./favicon.ico" />
  </head>
  <body>
    <div class="background"></div>

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
            <li class="header-nav-link">
              <a href="./exercises.php">Ejercicios</a>
            </li>
            <li class="header-nav-link active">
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
      <?php if (isset($_SESSION['macronutrients-calculate']) && $_SESSION['macronutrients-calculate']) { ?>
        <section id="calculate-result-section">
          <h1 id="calculate-result-title">Resultado</h1>
          <div class="calculate-result-container">
            <div class="calculate-result-item">
              <h2 class="calculate-result-item-title">Calorías</h2>
              <p class="calculate-result-item-value">
                <?php echo $_SESSION['macronutrients-calculate-calories']; ?>
              </p>
            </div>
            <div class="calculate-result-item">
              <h2 class="calculate-result-item-title">Proteínas</h2>
              <p class="calculate-result-item-value">
                <?php echo $_SESSION['macronutrients-calculate-protein']; ?>
              </p>
            </div>
            <div class="calculate-result-item">
              <h2 class="calculate-result-item-title">Grasas</h2>
              <p class="calculate-result-item-value">
                <?php echo $_SESSION['macronutrients-calculate-fat']; ?>
              </p>
            </div>
            <div class="calculate-result-item">
              <h2 class="calculate-result-item-title">Carbos</h2>
              <p class="calculate-result-item-value">
                <?php echo $_SESSION['macronutrients-calculate-carbs']; ?>
              </p>
            </div>
          </div>
          <a id="calculate-result-button" href="./calculator.php">
            <span class="material-icons"> refresh </span>
            Volver a calcular
          </a>
        </section>
      </main>

      <footer>
        <div class="footer-bottom">
          <p>&copy; 2023 Gymbrogains - Todos los derechos reservados</p>
        </div>
      </footer>

      <script src="./js/jquery/jquery-3.7.1.min.js"></script>
      <script src="./js/header.js"></script>
      <?php 
      unset($_SESSION['macronutrients-calculate']);
      unset($_SESSION['macronutrients-calculate-calories']);
      unset($_SESSION['macronutrients-calculate-protein']);
      unset($_SESSION['macronutrients-calculate-fat']);
      unset($_SESSION['macronutrients-calculate-carbs']);
      exit();
      } ?>
      <section id="form-section">
        <h1 id="form-title">
          Calculadora de calorías<span>y macro-nutrientes</span>
        </h1>
        <form action="./forms/calculator-form.php" method="POST" id="calculator-form">
          <?php if (isset($_SESSION['macronutrients-calculate']) && !$_SESSION['macronutrients-calculate']) {
            $eCode = $_SESSION['macronutrients-calculate-eCode'];
            switch($eCode){
              case 1:
                $eMessage = "Datos inválidos, intente de nuevo";
                break;
              case 2:
                $eMessage = "Sexo inválido, intente de nuevo";
                break;
              default:
                $eMessage = "Error desconocido, intente de nuevo más tarde";
                break;
            }
            ?>
          <div id="error-container-php">
            <p id="error-message">
              <?php echo $eMessage; ?>
            </p>
          </div>
          <?php
          unset($_SESSION['macronutrients-calculate-error']);
          unset($_SESSION['macronutrients-calculate']);
          } ?>
          <label for="weight">Peso (en kilogramos):</label>
          <input
            type="number"
            id="weight"
            name="weight"
            placeholder="Ingrese su peso"
            required
            aria-label="Peso en kilogramos"
            min="1"
            value="<?php if (isset($weight)) echo $weight; ?>"
          />

          <label for="height">Altura (en centímetros):</label>
          <input
            type="number"
            id="height"
            name="height"
            placeholder="Ingrese su altura"
            required
            aria-label="Altura en centímetros"
            min="1"
            value="<?php if (isset($height)) echo $height; ?>"
          />

          <label for="age">Edad:</label>
          <input
            type="number"
            id="age"
            name="age"
            placeholder="Ingrese su edad"
            required
            aria-label="Edad"
            min="1"
            value="<?php if (isset($age)) echo $age; ?>"
          />

          <label for="gender">Sexo:</label>
          <select id="gender" name="gender" required aria-label="Sexo">
            <option value="0" <?php if(isset($age) && $age ==  0) echo "selected" ?> >Hombre</option>
            <option value="1" <?php if(isset($age) && $age ==  1) echo "selected" ?> >Mujer</option>
          </select>

          <label for="goal">Objetivo:</label>
          <select id="goal" name="goal" required aria-label="Objetivo">
            <option value="0" <?php if(isset($goal) && $goal ==  1) echo "selected" ?> >Mantenimiento</option>
            <option value="1" <?php if(isset($goal) && $goal ==  0) echo "selected" ?> >Déficit</option>
            <option value="2" <?php if(isset($goal) && $goal ==  2) echo "selected" ?> >Volumen</option>
          </select>

          <label for="activity-level">Nivel de Actividad:</label>
          <select
            id="activity-level"
            name="activity-level"
            required
            aria-label="Nivel de actividad"
          >
            <option value="1.2" <?php if(isset($activityLevel) && $activityLevel ==  1.200) echo "selected" ?> >Sedentario (poco o ningún ejercicio)</option>
            <option value="1.375" <?php if(isset($activityLevel) && $activityLevel ==  1.375) echo "selected" ?> >
              Ligera actividad (ejercicio ligero o deportes 1-3 días a la
              semana)
            </option>
            <option value="1.55" <?php if(isset($activityLevel) && $activityLevel ==  1.550) echo "selected" ?> >
              Actividad moderada (ejercicio moderado o deportes 3-5 días a la
              semana)
            </option>
            <option value="1.725" <?php if(isset($activityLevel) && $activityLevel ==  1.725) echo "selected" ?> >
              Actividad intensa (ejercicio intenso o deportes 6-7 días a la
              semana)
            </option>
            <option value="1.9" <?php if(isset($activityLevel) && $activityLevel ==  1.900) echo "selected" ?> >
              Muy activo (trabajo físico y ejercicio diario intenso)
            </option>
          </select>

          <?php if (isset($_SESSION["user"])) { ?>
          <div class="checkbox-wrapper">
            <input type="checkbox" name="active" id="active" />
            <label for="active">
              ¿Deseas guardar el registro en tu historial de cálculos?
            </label>
          </div>
          <div class="checkbox-wrapper">
            <input type="checkbox" name="save-data" id="save-data" />
            <label for="save-data">
              ¿Deseas guardar los datos en tu cuenta?
            </label>
          </div>
          <?php } ?>

          <input
            type="submit"
            value="Calcular"
            aria-label="Calcular las calorías y macro-nutrientes"
            name="calculate"
            id="calculate-submit-button"
          />
        </form>
      </section>
    </main>

    <footer>
      <div class="footer-bottom">
        <p>&copy; 2023 Gymbrogains - Todos los derechos reservados</p>
      </div>
    </footer>

    <script src="./js/jquery/jquery-3.7.1.min.js"></script>
    <script src="./js/header.js"></script>
  </body>
</html>
