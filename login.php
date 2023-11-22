<?php
require_once './includes/session.php';

if (isset($_SESSION['user'])) {
  header('Location: ./index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar sesión | Gymbrogains</title>

  <link rel="stylesheet" href="./css/normalize.css" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/login-signup.css" />

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>
  <div class="background"></div>

  <a class="logo-link" href="./index.php">
    <img id="logo" src="./images/logo/white.webp" alt="Gymbrogains" />
  </a>

  <main>
    <div class="login-form-container">
      <form action="./auth/login.php" method="post" id="login-form">
        <?php if (isset($_SESSION['signup']) && $_SESSION['signup']) { ?>
          <div class="success-container">
            <p class="success-message">
              ¡Registro exitoso!
              <span class="wrap">
                Inicia sesión para continuar
              </span>
            </p>
          </div>
        <?php
          unset($_SESSION['signup']);
        } elseif (isset($_SESSION['login']) && !$_SESSION['login'] && isset($_SESSION['eCode'])) {
          switch ($_SESSION['eCode']) {
            case 3:
              $error_message = 'Nombre de usuario inválido';
              break;
            case 4:
              $error_message = 'Contraseña inválida';
              break;
            case 7:
              $error_message = 'Usuario no encontrado';
              break;
            case 8:
              $error_message = 'Contraseña incorrecta';
              break;
            default:
              $error_message = 'Error de ejecución';
              break;
          }
        ?>
          <div id="error-container-php">
            <p id="error-message"><?php echo $error_message ?></p>
          </div>
        <?php
          unset($_SESSION['login']);
          unset($_SESSION['eCode']);
        } else { ?>
          <div id="error-container">
            <p id="error-message"></p>
          </div>
        <?php } ?>
        <label for="login-username">Nombre de usuario:</label>
        <input type="text" name="login-username" id="login-username" placeholder="Nombre de usuario" maxlength="20" minlength="1" required tabindex="1" />
        <label for="login-password">Contraseña:</label>
        <input type="password" name="login-password" class="password-input" id="login-password" placeholder="Contraseña" maxlength="16" minlength="1" required tabindex="2" />
        <input type="submit" id="login-submit" name="login-submit" value="Iniciar sesión" tabindex="3" />
      </form>
      <p class="login-p">
        ¿No tienes cuenta?
        <a class="login-a" href="./signup.php">Regístrate</a>
      </p>
    </div>
  </main>

  <script src="./js/jquery/jquery-3.7.1.min.js"></script>
  <script src="./js/form-validate.js"></script>
</body>

</html>