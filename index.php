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

// $player = new FirstPersonView();
// $text = new FirstPersonText();
// $player->init();

if(isset($_GET['action'])) {
    $actions = $_GET['action'];
    $x = $_GET['x'];
    $y = $_GET['y'];
    $angle = $_GET['angle'];

    $player->setCurrentX($x);
    $player->setCurrentY($y);
    $player->setCurrentAngle($angle);
    $text->setCurrentX($x);
    $text->setCurrentY($y);
    $text->setCurrentAngle($angle);
    $actions->setCurrentX($x);
    $actions->setCurrentY($y);
    $actions->setCurrentAngle($angle);

    if($action == 'forward') {
        $player->goForward();
        $text->goForward();
        $actions->goForward();
    } else if ($action == 'back'){
        $player->goBack();
        $text->goBack();
        $actions->goBack();
    } else if ($action == 'right'){
        $player->goRight();
        $text->goRight();
        $actions->goRight();
    } else if ($action == 'left'){
        $player->goLeft();
        $text->goLeft();
        $actions->goLeft();
    } else if ($action == 'turnRight'){
        $player->turnRight();
        $text->turnRight();
        $actions->turnRight();
    } else if ($action == 'turnLeft'){
        $player->turnLeft();
        $text->turnLeft();
        $actions->turnLeft();
    } else if ($action == 'action') {
        $actions->doAction();
    } else {
        error_log('Erreur!', 0);
    }
}


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
            <p>Tié ou poulet de con</p>
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