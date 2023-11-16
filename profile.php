<?php
require_once 'includes/session.php';

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
  exit;
}

$user_id = $_SESSION['user']['UserId'];
$username = $_SESSION['user']['Username'];
$name = $_SESSION['user']['Name'];
$goals = $_SESSION['user']['Goals'];
$birth_date = $_SESSION['user']['BirthDate'];
$gender = $_SESSION['user']['Gender'] == 0 ? "Hombre" : "Mujer";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['userID']) &&  is_numeric($_GET['userID'])) {
  $conn = $db->connect();
  $user_id = $_GET['userID'];
  $sql = "SELECT Username, Name, Goals, BirthDate, Gender, GenderIdentity FROM users WHERE UserId = $user_id LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $result = $stmt->get_result();
  if (!$result->num_rows > 0) {
    header('Location: profile.php');
    exit;
  }

  $user = $result->fetch_assoc();

  $username = $user['Username'];
  $name = $user['Name'];
  $goals = $user['Goals'];
  $birth_date = $user['BirthDate'];
  $gender = $user['Gender'] == 0 ? "Hombre" : "Mujer";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil | <?php echo $username ?></title>

  <link rel="stylesheet" href="./fonts/css/index.css" />
  <link rel="stylesheet" href="./css/normalize.css" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/profile.css" />

  <link rel="icon" href="./favicon.ico" />
</head>
<body>
  <main>
    <section id="user-card">
      <header id="profile-header">
        <span class="material-icons">
          account_circle
        </span>
      </header>
      <article id="user-info">
        <h2 class="username">
          <?php echo $username ?>
        </h2>
        <div class="user-info-span-container">
          <span class="name-goals"><?php echo $name ?><span id="goals">: <?php echo $goals ?></span></span>
          <span class="birth-date">Fecha de nacimiento: <?php echo $birth_date ?></span>
          <span class="gender">Sexo: <?php echo $gender ?></span>
        </div>
      </article>
      <footer id="profile-footer">
        <ul>
          <li>
            <a href="./index.php" class="profile-footer-link">
              <span class="material-icons">
                home
              </span>
            </a>
          </li>
          <?php if (!isset($user)) { ?>
            <li>
              <a href="./auth/logout.php" class="profile-footer-link logout">
                <span class="material-icons">
                  logout
                </span>
              </a>
            </li>
          <?php } ?>
        </ul>
      </footer>
    </section>
  </main>

  <script src="./js/profile.js"></script>
</body>
</html>