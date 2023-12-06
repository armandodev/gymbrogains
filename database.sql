CREATE DATABASE IF NOT EXIST `gymbrogains` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `gymbrogains`;

CREATE TABLE IF NOT EXIST `exercises` (
  `ExerciseID` int(11) NOT NULL AUTO_INCREMENT,
  `ExerciseName` varchar(255) NOT NULL,
  `ExerciseDescription` text NOT NULL,
  `Category` varchar(15) NOT NULL,
  `AverageRating` decimal(3, 2) DEFAULT 0.00,
  PRIMARY KEY (`ExerciseID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXIST `exerciseratings` (
  `RatingID` int(11) NOT NULL AUTO_INCREMENT,
  `ExerciseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Rating` decimal(3, 2) NOT NULL,
  `RatingMessage` text DEFAULT NULL,
  PRIMARY KEY (`RatingID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `exercises` (
    `ExerciseID`,
    `ExerciseName`,
    `ExerciseDescription`,
    `Category`,
    `AverageRating`
  )
VALUES
  (
    1,
    'Press de banca',
    'El Press de banca, también conocido como bench press, es un ejercicio fundamental en el gimnasio que se centra en el desarrollo de la musculatura pectoral. Para realizarlo, te acuestas en un banco con una barra cargada y la levantas desde el pecho hasta la extensión completa de los brazos, fortaleciendo así tus músculos del pecho y tríceps.',
    'Gimnasio',
    4.00
  ),
  (
    2,
    'Sentadillas',
    'Las sentadillas son un ejercicio clave para el desarrollo de las piernas y los glúteos. Se realiza sosteniendo una barra en la parte superior de la espalda y doblando las rodillas para bajar el cuerpo hacia el suelo y luego regresar a la posición de pie. Este ejercicio no solo fortalece tus piernas, sino que también trabaja tu núcleo y equilibrio.',
    'Gimnasio',
    0.00
  ),
  (
    3,
    'Peso muerto',
    'El peso muerto es un ejercicio fundamental que se enfoca en fortalecer la espalda baja y todo el cuerpo. Se realiza levantando una barra desde el suelo hasta una posición de pie. Es un ejercicio intenso que trabaja los músculos de la espalda, glúteos, piernas y agarre.',
    'Gimnasio',
    0.00
  ),
  (
    4,
    'Dominadas',
    'Las dominadas son un ejercicio efectivo para fortalecer la parte superior del cuerpo, en particular los músculos de la espalda y los brazos. Se realizan colgándose de una barra y levantando el cuerpo hacia arriba hasta que el mentón esté por encima de la barra. Este ejercicio mejora la fuerza y resistencia de la parte superior del cuerpo.',
    'Gimnasio',
    0.00
  ),
  (
    5,
    'Fondos de tríceps',
    'Los fondos de tríceps son un ejercicio excelente para aislar y fortalecer los músculos tríceps. Se realizan con barras paralelas, bajando y levantando el cuerpo mediante el movimiento de los brazos. Este ejercicio es esencial para el desarrollo de los brazos y la fuerza en la parte superior del cuerpo.',
    'Gimnasio',
    0.00
  ),
  (
    6,
    'Dominadas',
    'Las dominadas son un ejercicio de calistenia que se realiza utilizando el peso corporal. Colgándote de una barra, levantas tu cuerpo hacia arriba para fortalecer la espalda, brazos y hombros. Es un ejercicio versátil y desafiante para desarrollar fuerza y control.',
    'Calistenia',
    0.00
  ),
  (
    7,
    'Fondos de pecho',
    'Los fondos de pecho son un ejercicio de calistenia que se enfoca en el desarrollo del pecho y los tríceps. Se realizan con el peso corporal apoyándote en barras paralelas y bajando y levantando el cuerpo. Este ejercicio es esencial para fortalecer la parte superior del cuerpo.',
    'Calistenia',
    0.00
  ),
  (
    8,
    'Plancha',
    'La plancha es un ejercicio de calistenia que se centra en fortalecer el núcleo y los músculos abdominales. Se realiza manteniendo el cuerpo en una posición recta y plana, apoyado sobre los codos y los dedos de los pies. La plancha es excelente para desarrollar la resistencia del núcleo.',
    'Calistenia',
    0.00
  ),
  (
    9,
    'Parada de manos',
    'La parada de manos es un desafiante ejercicio de equilibrio que se realiza sobre las manos. Requiere una gran fuerza en los brazos y los hombros, así como habilidades de equilibrio. La parada de manos es un ejercicio avanzado en calistenia que pone a prueba tu fuerza y control.',
    'Calistenia',
    0.00
  ),
  (
    10,
    'L-sit',
    'El L-sit es un ejercicio de calistenia que se centra en fortalecer el núcleo y los músculos abdominales. Se realiza levantando las piernas en forma de L mientras te apoyas en barras paralelas. Este ejercicio es desafiante y mejora la resistencia y la fuerza en el núcleo.',
    'Calistenia',
    0.00
  );

CREATE TABLE IF NOT EXIST `forum` (
  `TopicID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `TopicTitle` varchar(255) NOT NULL,
  `MessageContent` text NOT NULL,
  `PublicationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Likes` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`TopicID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `forum` (
    `TopicID`,
    `UserID`,
    `TopicTitle`,
    `MessageContent`,
    `PublicationDate`,
    `Likes`
  )
VALUES
  (
    1,
    1,
    'Mi primera publicación',
    '¡Hola a todos! Esta es mi primera publicación en el foro. Estoy emocionado de unirme a esta comunidad.',
    '2023-10-27 12:00:00',
    1
  ),
  (
    2,
    1,
    'Ejercicios de calistenia',
    'Hablemos de ejercicios de calistenia. ¿Cuáles son tus favoritos? ¿Tienes algún consejo para principiantes?',
    '2023-10-26 15:30:00',
    1
  ),
  (
    3,
    1,
    'Nutrición deportiva',
    '¿Alguien tiene recomendaciones sobre nutrición deportiva y suplementos? Comparte tus experiencias y consejos.',
    '2023-10-25 09:45:00',
    1
  ),
  (
    4,
    1,
    'Lesiones deportivas',
    'Discutamos la prevención y recuperación de lesiones deportivas. ¿Alguna historia personal que quieras compartir?',
    '2023-10-24 17:20:00',
    1
  ),
  (
    5,
    1,
    'Entrenamiento de resistencia',
    '¿Cómo entrenas la resistencia? Comparte tus rutinas y consejos para mejorar la resistencia.',
    '2023-10-23 14:15:00',
    1
  ),
  (
    6,
    1,
    'Motivación para el gimnasio',
    '¿Cómo te mantienes motivado para ir al gimnasio? Comparte tus trucos para vencer la pereza.',
    '2023-10-22 10:10:00',
    1
  ),
  (
    7,
    1,
    'Dieta cetogénica',
    'Hablemos de la dieta cetogénica. ¿La has probado? ¿Qué resultados has obtenido?',
    '2023-10-21 19:55:00',
    1
  ),
  (
    8,
    1,
    'Ganar músculo',
    'Comparte tus estrategias para ganar músculo. ¿Tienes un programa de entrenamiento específico?',
    '2023-10-20 11:25:00',
    1
  ),
  (
    9,
    1,
    'Salud mental y ejercicio',
    'La salud mental es importante. ¿Cómo el ejercicio ha mejorado tu bienestar mental? Comparte tus historias.',
    '2023-10-19 08:40:00',
    1
  ),
  (
    10,
    1,
    'Consejos para principiantes',
    'Si eres nuevo en el mundo del fitness, este es el lugar para obtener consejos de los expertos. ¡Pregunta lo que necesites!',
    '2023-10-18 16:30:00',
    1
  ),
  (
    11,
    1,
    'Equipamiento de gimnasio en casa',
    'Hablemos del equipamiento necesario para entrenar en casa. ¿Qué recomiendas tener en casa?',
    '2023-10-17 13:10:00',
    1
  ),
  (
    12,
    1,
    'Rutinas de entrenamiento',
    '¿Cuál es tu rutina de entrenamiento favorita? Comparte tus ejercicios y planes de entrenamiento.',
    '2023-10-16 14:50:00',
    1
  ),
  (
    13,
    1,
    'Culturismo versus calistenia',
    'Debates sobre culturismo y calistenia. ¿Cuál prefieres y por qué?',
    '2023-10-15 18:20:00',
    1
  ),
  (
    14,
    1,
    'Maratón de running',
    '¿Alguien está entrenando para un maratón? Comparte tus experiencias y consejos sobre correr largas distancias.',
    '2023-10-14 10:05:00',
    1
  ),
  (
    15,
    1,
    'Recetas saludables',
    'Comparte tus recetas saludables y equilibradas para una dieta fitness. ¡Todos necesitamos ideas para comer mejor!',
    '2023-10-13 12:35:00',
    1
  );

CREATE TABLE IF NOT EXIST `forumlikes` (
  `likeID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `TopicID` int(11) NOT NULL,
  PRIMARY KEY (`likeID`, `userID`, `TopicID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `forumlikes` (`likeID`, `userID`, `TopicID`)
VALUES
  (1, 201, 1),
  (2, 202, 2),
  (3, 203, 3),
  (4, 204, 4),
  (5, 205, 5),
  (6, 206, 6),
  (7, 207, 7),
  (8, 208, 8),
  (9, 209, 9),
  (10, 210, 10),
  (11, 211, 11),
  (12, 212, 12),
  (13, 213, 13),
  (14, 214, 14),
  (15, 215, 15);

CREATE TABLE IF NOT EXIST `macronutrients` (
  `NutrientID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Goal` smallint(6) NOT NULL,
  `ActivityLevel` decimal(10, 3) NOT NULL,
  `TotalCalories` decimal(10, 2) NOT NULL,
  `Carbohydrates` decimal(10, 2) NOT NULL,
  `Fats` decimal(10, 2) NOT NULL,
  `Proteins` decimal(10, 2) NOT NULL,
  `CalculationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`NutrientID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXIST `userprogress` (
  `ProgressID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Weight` decimal(10, 2) NOT NULL,
  `Height` decimal(10, 2) NOT NULL,
  `PublicationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ProgressID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE IF NOT EXIST `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(32) NOT NULL,
  `BirthDate` date NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Goals` varchar(300) DEFAULT NULL,
  `Role` tinyint(4) NOT NULL DEFAULT 1,
  `Gender` tinyint(4) NOT NULL,
  `GenderIdentity` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
