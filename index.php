<?php
// Fonction d'autoload
function my_autoload($class) {
    require_once $class . '.php';
}

// Enregistre la fonction d'autoload
spl_autoload_register('my_autoload');

// Utilisation de la classe Database
try {
    $db = new Database();
    // echo "Connexion réussie à la base de données.";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}


// // Initialisation des objets de jeu : ces objets gèrent l'état du jeu
// $player = new FirstPersonView();  // Représente la vue du joueur (position et orientation)
// $text = new FirstPersonText();    // Gère le texte affiché (description)
// // $actions = new FirstPersonAction();  // Gère les actions du joueur
// $player->init();  // Initialisation du joueur (par exemple, position initiale)

// // Gestion des actions du joueur en fonction des paramètres dans l'URL
// if (isset($_GET['action'])) {
//     // Récupération des paramètres passés dans l'URL (action, coordonnées x et y, et angle)
//     $action = $_GET['action'];
//     $x = $_GET['x'];  // Position actuelle en X
//     $y = $_GET['y'];  // Position actuelle en Y
//     $angle = $_GET['angle'];  // Angle actuel de la vue du joueur

//     // Mise à jour des coordonnées et de l'angle dans les objets correspondants
//     $player->setCurrentX($X);
//     $player->setCurrentY($Y);
//     $player->setCurrentAngle($Angle);
    
//     $text->setCurrentX($X);  // Mise à jour des coordonnées dans le texte
//     $text->setCurrentY($Y);
//     $text->setCurrentAngle($Angle);
    
//     $actions->setCurrentX($x);  // Mise à jour des coordonnées dans les actions
//     $actions->setCurrentY($y);
//     $actions->setCurrentAngle($Angle);

//     // Effectuer l'action appropriée en fonction de l'action choisie
//     switch ($action) {
//         case 'forward':
//             // Déplacement en avant
//             $player->goForward();
//             $text->goForward();
//             $actions->goForward();
//             break;
//         case 'back':
//             // Déplacement en arrière
//             $player->goBack();
//             $text->goBack();
//             $actions->goBack();
//             break;
//         case 'right':
//             // Rotation à droite
//             $player->goRight();
//             $text->goRight();
//             $actions->goRight();
//             break;
//         case 'left':
//             // Rotation à gauche
//             $player->goLeft();
//             $text->goLeft();
//             $actions->goLeft();
//             break;
//         case 'turnRight':
//             // Tourner à droite
//             $player->turnRight();
//             $text->turnRight();
//             $actions->turnRight();
//             break;
//         case 'turnLeft':
//             // Tourner à gauche
//             $player->turnLeft();
//             $text->turnLeft();
//             $actions->turnLeft();
//             break;
        // case 'action':
        //     // Effectuer une action (par exemple, ouvrir une porte)
        //     $actions->doAction();
        //     break;
        // default:
        //     // Si l'action est inconnue, on log l'erreur
        //     error_log('Erreur inconnue!', 0);
        //     break;
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8002029057.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="jeu">
        <div class="ecran">
            <img src="images/01-0.jpg" alt="ecran_jeu">
        </div>
        <div class="text">
            <p>Tié ou poulet de con! miam</p>
        </div>
        <div class="autre">

        <img src="assets/comp-est.png" alt="">
            <form class="controls">
        <div class="row">
            <button type="button" name=""><i class="fa-solid fa-rotate-left"></i></button>
            <button type="button" name=""><i class="fa-solid fa-arrow-up"></i></button>
            <button type="button" name=""><i class="fa-solid fa-rotate-right"></i></button>
        </div>
        <div class="row">
            <button type="button" name=""><i class="fa-solid fa-arrow-left"></i></button>
            <button type="button" name=""><i class="fa-solid fa-hand"></i></button>
            <button type="button" name=""><i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div class="row center">
            <button type="button" name=""><i class="fa-solid fa-arrow-down"></i></button>
        </div>
    </form>

        </div>
    </div>
</body>
</html>