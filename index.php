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
            <p>Trouvez le Saint Poulet.</p>
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