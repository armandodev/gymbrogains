<?php
require_once './includes/session.php';

if(isset($_SESSION['user'])) {
  header('Location: ./index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Regístrate | Gymbrogains</title>

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
      <div class="signup-form-container">
        <form action="./auth/signup.php" method="post" id="signup-form">
          <?php if(isset($_SESSION['signup']) && !$_SESSION['signup'] && isset($_SESSION['eCode'])) {
              switch($_SESSION['eCode']) {
                case 1:
                  $error_message = 'Nombre inválido, solo se permiten letras';
                  break;
                case 2:
                  $error_message = 'Apellido inválido, solo se permiten letras';
                  break;
                case 3:
                  $error_message = 'Nombre de usuario inválido, solo se permiten letras y números';
                  break;
                case 4:
                  $error_message = 'Contraseña inválida, solo se permiten letras y números';
                  break;
                case 5:
                  $error_message = 'Sexo inválido, solo se permiten números';
                  break;
                case 6:
                  $error_message = 'Género inválido, solo se permiten números';
                  break;
                case 7:
                  $error_message = 'El usuario ya esta registrado, intente con otro nombre de usuario o inicie sesión';
                  break;
                case 8:
                  $error_message = 'Contraseña incorrecta, intente con otra contraseña';
                  break;
                default:
                  $error_message = 'Error desconocido, intente de nuevo más tarde';
                  break;
              }
          ?>
            <div id="error-container-php">
              <p id="error-message"><?php echo $error_message ?></p>
            </div>
          <?php 
            unset($_SESSION['signup']);
            unset($_SESSION['eCode']);
          } else { ?>
            <div id="error-container">
              <p id="error-message"></p>
            </div>
          <?php } ?>
          <div class="inputs-container">
            <div class="input-container">
              <label for="signup-name"
                >Nombre<span class="input-required">*</span></label
              >
              <input
                type="text"
                name="signup-name"
                id="signup-name"
                placeholder="Nombre"
                maxlength="30"
                minlength="2"
                required
                tabindex="1"
              />
            </div>
            <div class="input-container">
              <label for="signup-last-name"
                >Apellido<span class="input-required">*</span></label
              >
              <input
                type="text"
                name="signup-last-name"
                id="signup-last-name"
                placeholder="Apellido"
                maxlength="30"
                minlength="2"
                required
                tabindex="2"
              />
            </div>
          </div>
          <label for="signup-username"
            >Nombre de usuario<span class="input-required">*</span></label
          >
          <input
            type="text"
            name="signup-username"
            id="signup-username"
            placeholder="Nombre de usuario"
            maxlength="20"
            minlength="6"
            required
            tabindex="3"
          />
          <label for="signup-password"
            >Contraseña<span class="input-required">*</span></label
          >
          <input
            type="password"
            name="signup-password"
            id="signup-password"
            placeholder="Contraseña"
            maxlength="16"
            minlength="6"
            required
            tabindex="4"
          />
          <label for="signup-goals">Descripción</label>
          <textarea
            name="signup-goals"
            id="signup-goals"
            cols="30"
            rows="10"
            maxlength="300"
            minlength="10"
            tabindex="5"
            placeholder="Descripción (Opcional)"
          ></textarea>
          <label for="signup-birth-date"
            >Fec. de Nacimiento<span class="input-required">*</span></label
          >
          <input
            type="date"
            name="signup-birth-date"
            id="signup-birth-date"
            required
            tabindex="6"
          />
          <div class="inputs-container">
            <div class="input-container">
              <label for="signup-gender"
                >Sexo<span class="input-required">*</span></label
              >
              <select
                name="signup-gender"
                id="signup-gender"
                required
                tabindex="7"
              >
                <option value="NULL" disabled selected hidden>
                  (Selecciona)
                </option>
                <option value="0">Hombre</option>
                <option value="1">Mujer</option>
              </select>
            </div>
            <div class="input-container">
              <label for="signup-gender-identity">Genero</label>
              <select
                name="signup-gender-identity"
                id="signup-gender-identity"
                tabindex="8"
              >
                <option value="NULL" disabled selected hidden>
                  (Opcional)
                </option>
                <option value="0">Masculino</option>
                <option value="1">Femenino</option>
              </select>
            </div>
          </div>
          <input
            type="submit"
            id="signup-submit"
            name="signup-submit"
            value="Regístrate"
            tabindex="9"
          />
        </form>
        <p class="signup-p">
          ¿Ya tienes cuenta?
          <a class="signup-a" href="./login.php">Inicia sesión</a>
        </p>
      </div>
    </main>

    <!-- <script src="./js/jquery/jquery-3.7.1.min.js"></script>
    <script src="./js/form-validate.js"></script> -->
  </body>
</html>
