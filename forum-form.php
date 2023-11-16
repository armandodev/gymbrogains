<?php
require_once "includes/session.php";

if (!isset($_SESSION["user"])) {
  header("Location: ./login.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario de Publicación de Temas</title>
    
    <link rel="stylesheet" href="./fonts/css/index.css">
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/forum-form.css" />
  </head>
  <body>
    <main>
      <section id="form">
        <form method="POST" action="./forms/forum-form.php">
          <label>
            Título:
            <input
            type="text"
            id="topic-title"
            name="topic-title"
            placeholder="Título del tema"
            />
          </label>
          <label>
            Contenido:
            <textarea
            id="content"
            name="content"
            placeholder="Escribe aquí tu tema"
            ></textarea>
          </label>
          <div class="submit-button">
            <input type="submit" value="Publicar" />
          </div>
        </form>
      </section>
    </main>
  </body>
</html>
