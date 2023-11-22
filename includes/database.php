<?php
class Database
{
  // Datos de configuración de la base de datos
  private $host = "localhost"; // Host de la base de datos
  private $database = "gymbrogains"; // Nombre de la base de datos
  private $username = "root"; // Nombre de usuario de la base de datos
  private $password = ""; // Contraseña de la base de datos

  // Método para establecer la conexión a la base de datos
  public function connect()
  {
    try {
      // Intenta conectar a la base de datos utilizando los datos de configuración
      $connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

      if (!$connection) {
        // Si la conexión falla, lanza una excepción con un mensaje de error
        throw new Exception("Error de conexión a la base de datos", 1);
      }

      // Retorna la conexión si se establece con éxito
      return $connection;
    } catch (Exception $e) {
      // Si se produce una excepción, retorna el mensaje de error
      return $e->getMessage();
    }
  }

  // Método para validar la conexión
  public function validateConnection($connection)
  {
    // Verifica si la conexión no es una cadena (es decir, es una conexión válida)
    if (!is_string($connection)) return true;
    else return false;
  }

  // Método para obtener información de un usuario por su ID
  public function getUserById()
  {
    // Obtiene el ID de usuario de la sesión actual
    $user_id = $_SESSION['user']['UserId'];

    // Establece una conexión a la base de datos
    $conn = $this->connect();

    // Prepara una consulta SQL para seleccionar información del usuario
    $sql = "SELECT UserId, Name, Username, BirthDate, Goals, Role, Gender, GenderIdentity FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);

    // Vincula el ID de usuario como parámetro en la consulta
    $stmt->bind_param("i", $user_id);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene el resultado de la consulta
    $result = $stmt->get_result();

    // Cierra la consulta
    $stmt->close();

    // Obtiene la fila de resultados (información del usuario) como un arreglo asociativo
    $row = $result->fetch_assoc();

    // Almacena la información del usuario en la sesión para su posterior uso
    $_SESSION['user'] = $row;
  }
}
