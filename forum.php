<?php
require_once "./includes/session.php";

if (!isset($_SESSION['user'])) {
  header("Location: ./login.php");
}

$conn = $db->connect();

// Get total number of publications
$sql = "SELECT COUNT(*) AS count FROM forum";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->fetch_assoc()['count'];

// Calculate number of pages
$per_page = 10;
$total_pages = ceil($count / $per_page);

// Get current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate offset
$offset = ($page - 1) * $per_page;

// Get publications for current page
$sql = "SELECT users.UserID, users.Username, forum.TopicID, forum.PublicationDate, forum.TopicTitle, forum.MessageContent, Likes
  FROM forum, users
  WHERE forum.UserID = users.UserID
  GROUP BY forum.TopicID
  ORDER BY forum.PublicationDate DESC LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $per_page);
$stmt->execute();
$result = $stmt->get_result();
$publications = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foro | Gymbrogains</title>

    <link rel="stylesheet" href="./fonts/css/index.css" />
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/forum.css" />

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
            <li class="header-nav-link">
              <a href="./exercises.php">Ejercicios</a>
            </li>
            <li class="header-nav-link">
              <a href="./calculator.php">Calculadora</a>
            </li>
            <li class="header-nav-link active">
              <a href="./forum.php">Foro</a>
            </li>
            <li class="header-nav-link">
              <a href="./profile.php">
                <span class="material-icons"> account_circle </span>
                <span id="profile-nav"></span>
              </a>
            </li>
            <li class="header-nav-link">
              <a href="./forum-form.php">
                <span class="material-icons"> add </span>
                <span id="forum-form"></span>
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
            } ?>
          </ul>
        </nav>

        <button id="menu-button">
          <span class="material-icons"> menu </span>
        </button>
      </div>
    </header>

    <main>
    <section id="publications">
        <?php if ($result->num_rows > 0) { ?>
          <?php foreach ($publications as $publication) {
            $buttonId = $publication["TopicID"];
            $userID = $publication['UserID'];
            ?>
          <article class="publication">
            <div class="publication-header">
              <a
              class="publication-header-username"
              href="./profile.php?userID=<?php echo urlencode($publication['Username']) ?>"
              >
                @<?php echo $publication['Username']; ?>
              </a>
              <p class="publication-header-date">
                <?php echo $publication['PublicationDate']; ?>
              </p>
            </div>
            <div class="publication-body">
              <h2 class="publication-body-title">
                <?php echo $publication['TopicTitle']; ?>
              </h2>
              <p class="publication-body-content">
                <?php echo $publication['MessageContent']; ?>
              </p>
            </div>
            <div class="publication-footer">
              <?php
                $conn = $db->connect();

                $sql = "SELECT * FROM forumlikes WHERE TopicID = ? AND UserID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $buttonId, $userID);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                $conn->close();
                
                $liked = $result->num_rows > 0 ? true : false;
              ?>
              <button
              id="<?php echo $publication["TopicID"] ?>"
              class="publication-footer-reaction-button"
              <?php if ($liked) { 
                echo "disabled";
              } ?>
              >
                <span class="material-icons"> thumb_up </span>
                <span id="<?php echo $publication["TopicID"] ?>-count" class="publication-footer-reactions-count">
                  <?php echo $publication['Likes']; ?>
                </span>
              </button>
            </div>
          </article>
          <?php } ?>
          <div class="pagination">
            <?php
            $i = 1;
            do { ?>
              <a href="forum.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
              <?php 
              $i++;
            } while ($i <= $total_pages) ?>
          </div>
        <?php } else { ?>
          <p class="empty">
            <span>
              No hay publicaciones en el foro, <a href="./forum-form.php">¡publica una!</a>
            </span>
          </p>
        <?php } ?>
      </section>
    </main>

    <footer>
      <div class="footer-bottom">
        <p>&copy; 2023 Gymbrogains - Todos los derechos reservados</p>
      </div>
    </footer>

    <script src="./js/jquery/jquery-3.7.1.min.js"></script>
    <script src="./js/header.js"></script>
    <script src="./js/pagination.js"></script>
    <script src="./js/likes.js"></script>
  </body>
</html>
