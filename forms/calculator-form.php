<?php
// Incluye el archivo de sesión
require_once "../includes/session.php";

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Redirecciona a la página calculator.php si la solicitud no es de tipo POST
    header('Location: ./../calculator.php');
    exit();
}

try {
    // Conecta a la base de datos
    $conn = $db->connect();

    // Obtiene los valores del formulario
    $weight = floatval($_POST["weight"]);
    $height = floatval($_POST["height"]);
    $age = intval($_POST["age"]);
    $gender = intval($_POST['gender']);
    $goal = intval($_POST['goal']);
    $activity = floatval($_POST['activity-level']);

    // Verifica la validez de los datos ingresados
    if ($weight <= 0 || $height <= 0 || $age <= 0 || ($gender !== 0 && $gender !== 1) || ($goal < 0 || $goal > 2) || ($activity < 1.2 || $activity > 1.9)) {
        throw new Exception("Datos inválidos", 1);
    }

    // Calcula el BMR (Tasa Metabólica Basal) basado en el género
    if ($gender === 0) {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
    } elseif ($gender === 1) {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    } else {
        throw new Exception("Sexo inválido", 2);
    }

    // Define los factores de actividad
    $activityFactors = [1.2, 1.375, 1.55, 1.725, 1.9];
    $activityFactor = $activityFactors[array_search($activity, $activityFactors)];

    // Calcula las calorías diarias necesarias
    $calories = $bmr * $activityFactor;

    // Define los ratios de calorías, proteínas y grasas según el objetivo
    $calorieRatios = [1.0, 0.8, 1.2];
    $calories *= $calorieRatios[$goal];

    $proteinRatios = [2, 2.2, 2];
    $fatRatios = [0.8, 0.7, 0.9];

    // Calcula las cantidades de proteínas, grasas y carbohidratos
    $protein = $weight * $proteinRatios[$goal];
    $fat = $weight * $fatRatios[$goal];
    $carbs = ($calories - ($protein * 4) - ($fat * 9)) / 4;

    // Redondea los valores
    $calories = round($calories);
    $protein = round($protein);
    $fat = round($fat);
    $carbs = round($carbs);

    // Verifica si hay una sesión de usuario activa
    if (isset($_SESSION['user'])) {
        $active = isset($_POST['active']) ? 1 : 0;
        $sql = "INSERT INTO macronutrients (UserId, Goal, ActivityLevel, TotalCalories, Carbohydrates, Fats, Proteins, Active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iidiiiii", $_SESSION['user']['UserId'], $goal, $activity, $calories, $carbs, $fat, $protein, $active);

        if (!$stmt->execute()) {
            throw new Exception("Error de ejecución al insertar en macronutrients");
        }

        // Verifica si se debe guardar información de progreso
        if (isset($_POST['save-data'])) {
            $sql = "INSERT INTO userprogress (UserId, Weight, Height) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iid", $_SESSION['user']['UserId'], $weight, $height);

            if (!$stmt->execute()) {
                throw new Exception("Error de ejecución al insertar en userprogress");
            }
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    }

    // Establece variables de sesión con los resultados
    $_SESSION['macronutrients-calculate'] = true;
    $_SESSION['macronutrients-calculate-calories'] = $calories;
    $_SESSION['macronutrients-calculate-protein'] = $protein;
    $_SESSION['macronutrients-calculate-fat'] = $fat;
    $_SESSION['macronutrients-calculate-carbs'] = $carbs;

    // Redirecciona de nuevo a la página calculator.php
    header('Location: ./../calculator.php');
    exit();
} catch (Exception $e) {
    $eCode = $e->getCode();
    // Establece variables de sesión para indicar un error
    $_SESSION['macronutrients-calculate'] = false;
    $_SESSION['macronutrients-calculate-eCode'] = $eCode;
    // Redirecciona a la página calculator.php en caso de error
    header('Location: ./../calculator.php');
    exit();
}
?>
