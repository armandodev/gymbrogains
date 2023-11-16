<?php
require_once './includes/session.php';
if (!$_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Location: ./exercises.php');
    exit();
}

$id = $_GET['id'];
$conn = $db->connect();
$sql = "SELECT * FROM exercises WHERE ExerciseID = $id LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
  header('Location: ./exercises.php');
  exit();
}
$exercise = $result->fetch_assoc(); $conn->close();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $exercise['ExerciseName']; ?></title>

    <link rel="stylesheet" href="./fonts/css/index.css" />
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/exercises-details.css" />
    <link rel="stylesheet" href="./css/exercises-rating-form.css" />
    <link rel="stylesheet" href="./css/exercises-comments.css" />

    <link rel="icon" href="./favicon.ico" />
  </head>
  <body>
    <main>
      <section id="exercise-details-section">
        <div id="exercise-details-container">
          <div id="exercise-details-header">
            <a href="./exercises.php">
              <span class="material-icons"> arrow_back </span>
            </a>
            <h1><?php echo $exercise['ExerciseName']; ?></h1>
          </div>
          <div id="exercise-details-body">
            <div id="exercise-details-image">
              <img
                src="./images/exercises/<?php echo $exercise['ExerciseID']; ?>-1.webp"
                alt="<?php echo $exercise['ExerciseName']; ?>"
              />
            </div>
            <?php
            $stars = array(0, 5);
            switch($exercise['AverageRating']) {
              case $exercise['AverageRating'] >= 0 && $exercise['AverageRating'] < 1:
                $stars = array(0, 5);
                break;
              case $exercise['AverageRating'] >= 1 && $exercise['AverageRating'] < 2:
                $stars = array(1, 4);
                break;
              case $exercise['AverageRating'] >= 2 && $exercise['AverageRating'] < 3:
                $stars = array(2, 3);
                break;
              case $exercise['AverageRating'] >= 3 && $exercise['AverageRating'] < 4:
                $stars = array(3, 2);
                break;
              case $exercise['AverageRating'] >= 4 && $exercise['AverageRating'] < 5:
                $stars = array(4, 1);
                break;
              case 5.00:
                $stars = array(5, 0);
                break;
              default:
                $stars = array(0, 5);
                break;
            }
            ?>
            <p class="rating">
              <?php for ($i = 0; $i < $stars[0]; $i++) { ?>
                <span class="material-icons star-filled">star</span>
              <?php } ?>
              <?php for ($i = 0; $i < $stars[1]; $i++) { ?>
                <span class="material-icons star-unfilled">star_border</span>
              <?php } ?> 
            </p>
            <p id="exercise-details-description">
              <?php echo $exercise['ExerciseDescription']; ?>
            </p>
          </div>
          <div id="exercise-rate-form">
            <?php
            if(isset($_SESSION['user']['UserId'])) {
              $conn = $db->connect();
              $sql = "SELECT ExerciseID, UserID FROM exerciseratings WHERE ExerciseID = ? AND UserID = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("ii", $id, $_SESSION['user']['UserId']);

              $stmt->execute();
              $result = $stmt->get_result();
              $stmt->close();

              if ($result->num_rows != 0) {
                $sql = "SELECT users.Username, exerciseRatings.Rating, exerciseRatings.RatingMessage
                        FROM exerciseRatings, users
                        WHERE
                        ExerciseID = ? &&
                        exerciseRatings.RatingMessage IS NOT NULL &&
                        exerciseRatings.UserID = users.UserID &&
                        exerciseRatings.UserID = ?
                        LIMIT 1";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                  $stmt->bind_param("ii", $id, $_SESSION['user']['UserId']);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $stmt->close();

                  if ($result->num_rows != 0) {
                    $user_comment = $result->fetch_assoc();
                  ?>
                    <div id="user-comment">
                      <?php
                      $stars = array(0, 5);
                      switch($user_comment['Rating']) {
                        case $user_comment['Rating'] >= 0 && $user_comment['Rating'] < 1:
                          $stars = array(0, 5);
                          break;
                        case $user_comment['Rating'] >= 1 && $user_comment['Rating'] < 2:
                          $stars = array(1, 4);
                          break;
                        case $user_comment['Rating'] >= 2 && $user_comment['Rating'] < 3:
                          $stars = array(2, 3);
                          break;
                        case $user_comment['Rating'] >= 3 && $user_comment['Rating'] < 4:
                          $stars = array(3, 2);
                          break;
                        case $user_comment['Rating'] >= 4 && $user_comment['Rating'] < 5:
                          $stars = array(4, 1);
                          break;
                        case 5.00:
                          $stars = array(5, 0);
                          break;
                        default:
                          $stars = array(0, 5);
                          break;
                      }
                      ?>
                      <h2>Tu reseña</h2>
                      <div class="exercise-comment">
                        <h3 class="user"><?php echo $user_comment['Username'] ?></h3>
                        <div class="comment-rate">
                          <?php for ($i = 0; $i < $stars[0]; $i++) { ?>
                            <span class="material-icons star-filled">star</span>
                          <?php } ?>
                          <?php for ($i = 0; $i < $stars[1]; $i++) { ?>
                            <span class="material-icons star-unfilled">star_border</span>
                          <?php } ?> 
                        </div>
                        <p class="comment-text">
                          <?php echo $user_comment['RatingMessage'] ?>
                        </p>
                      </div>
                    </div>
                  <?php } else { ?>
                  <?php
                  }
                } else {
                  $sql = "SELECT users.Username, exerciseRatings.Rating
                        FROM exerciseRatings, users
                        WHERE
                        ExerciseID = ? &&
                        exerciseRatings.UserID = users.UserID &&
                        exerciseRatings.UserID = ?
                        LIMIT 1";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("ii", $id, $_SESSION['user']['UserId']);

                  $stmt->execute();
                  $result = $stmt->get_result();
                  $stmt->close();

                  if ($result->num_rows != 0) {
                    $user_comment = $result->fetch_assoc();
                  ?>
                    <div id="user-comment">
                      <?php
                      $stars = array(0, 5);
                      switch($user_comment['Rating']) {
                        case $user_comment['Rating'] >= 0 && $user_comment['Rating'] < 1:
                          $stars = array(0, 5);
                          break;
                        case $user_comment['Rating'] >= 1 && $user_comment['Rating'] < 2:
                          $stars = array(1, 4);
                          break;
                        case $user_comment['Rating'] >= 2 && $user_comment['Rating'] < 3:
                          $stars = array(2, 3);
                          break;
                        case $user_comment['Rating'] >= 3 && $user_comment['Rating'] < 4:
                          $stars = array(3, 2);
                          break;
                        case $user_comment['Rating'] >= 4 && $user_comment['Rating'] < 5:
                          $stars = array(4, 1);
                          break;
                        case 5.00:
                          $stars = array(5, 0);
                          break;
                        default:
                          $stars = array(0, 5);
                          break;
                      }
                  } 
                }
              }  else { ?>
                <form action="./forms/rate-form.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <h2>Califica este ejercicio</h2>

                  <select name="rate" id="rate" require>
                    <option value="1">1 estrella</option>
                    <option value="2">2 estrellas</option>
                    <option value="3">3 estrellas</option>
                    <option value="4">4 estrellas</option>
                    <option value="5">5 estrellas</option>
                  </select>

                  <label>
                    Comentario
                    <br />
                    <textarea
                      name="comment"
                      id="comment"
                      placeholder="Comentario (Opcional)"
                    ></textarea>
                  </label>

                  <button type="submit">Publicar</button>
                </form>
              <?php }
              $conn->close();
            } else { ?>
              <div id="user-comment">
                <h2>Califica este ejercicio</h2>
                <p><a id="login-link" href="./login.php">Inicia sesión</a> para calificar este ejercicio</p>
              </div>
            <?php } ?>
          </div>
          <?php
          $conn = $db->connect();

          $sql = "SELECT users.Username, exerciseRatings.Rating, exerciseRatings.RatingMessage
                  FROM exerciseRatings, users
                  WHERE ExerciseID = ? AND
                        exerciseRatings.RatingMessage IS NOT NULL AND
                        exerciseRatings.UserID = users.UserID";
          if (isset($_SESSION['user']['UserId'])) {
            $sql .= " AND exerciseRatings.UserID != ?";
          }
          $sql .= " ORDER BY exerciseRatings.Rating DESC";
          $stmt = $conn->prepare($sql);
          if ($stmt) {
            isset($_SESSION['user']['UserId']) ? $stmt->bind_param("ii", $id, $_SESSION['user']['UserId']) : $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result->num_rows != 0) {
            $comments = $result->fetch_all(MYSQLI_ASSOC);
            ?>
              <div id="exercise-comments">
              <?php foreach($comments as $comment) {
                $stars = array(0, 5);
                switch($comment['Rating']) {
                  case $comment['Rating'] >= 0 && $comment['Rating'] < 1:
                    $stars = array(0, 5);
                    break;
                  case $comment['Rating'] >= 1 && $comment['Rating'] < 2:
                    $stars = array(1, 4);
                    break;
                  case $comment['Rating'] >= 2 && $comment['Rating'] < 3:
                    $stars = array(2, 3);
                    break;
                  case $comment['Rating'] >= 3 && $comment['Rating'] < 4:
                    $stars = array(3, 2);
                    break;
                  case $comment['Rating'] >= 4 && $comment['Rating'] < 5:
                    $stars = array(4, 1);
                    break;
                  case 5.00:
                    $stars = array(5, 0);
                    break;
                  default:
                    $stars = array(0, 5);
                    break;
                }
                ?>
                <div class="exercise-comment">
                  <h3 class="user"><?php echo $comment['Username'] ?></h3>
                  <div class="comment-rate">
                    <?php for ($i = 0; $i < $stars[0]; $i++) { ?>
                      <span class="material-icons star-filled">star</span>
                    <?php } ?>
                    <?php for ($i = 0; $i < $stars[1]; $i++) { ?>
                      <span class="material-icons star-unfilled">star_border</span>
                    <?php } ?> 
                  </div>
                  <p class="comment-text">
                    <?php echo $comment['RatingMessage'] ?>
                  </p>
                </div>
              <?php } ?>
              </div>
            <?php } else { ?>
              <div id="exercise-comments">
                <p class="no-comments">No hay comentarios</p>
              </div>
          <?php }
          }?>
        </div>
      </section>
    </main>
  </body>
</html>
