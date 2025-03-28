<?php

// Classe de base contenant les coordonnées, l'angle et la connexion à la base de données
class BaseClass {
    private $_currentX = 0; // Coordonnée X actuelle
    private $_currentY = 1; // Coordonnée Y actuelle
    private $_currentAngle = 0; // Angle de vue actuel (0, 90, 180, 270)
    private $_dbh; // Connexion à la base de données
}

// Constructeur qui initialise les propriétés de la classe
public function __construct($currentX, $currentY, $currentAngle,$dbh){
    $this->_currentX = $currentX; // Initialisation de la coordonnée X
    $this->_currentY = $currentY; // Initialisation de la coordonnée Y
    $this->_currentAngle = $currentAngle; // Initialisation de l'angle de vue
    $this->_dbh = $dbh; // Initialisation de la connexion à la base de données
}

// Méthode privée pour vérifier la possibilité de déplacement vers une position cible (à compléter)
public function __checkMove($x, $y, $angle) {
    // Requête SQL pour vérifier si une position (x, y) avec l'angle donné existe dans la base de données
    $sql = "SELECT id FROM map WHERE coordX=:x AND coordY=:y AND direction=:angle";
    $query = $this->_dbh->prepare($sql); // Prépare la requête SQL
    $query->bindParam(':y', $y, PDO::PARAM_INT); // Lie la valeur de y au paramètre
    $query->bindParam(':x', $x, PDO::PARAM_INT); // Lie la valeur de x au paramètre
    $query->bindParam(':angle', $angle, PDO::PARAM_INT); // Lie l'angle au paramètre
    $query->execute(); // Exécute la requête SQL
    $newPos = $query->fetch(PDO::FETCH_OBJ); // Récupère le résultat sous forme d'objet
    $result = isset($newPos->id) ? true : false; // Si une position est trouvée, on retourne vrai, sinon faux
    return $result; // Retourne le résultat de la vérification
}

public function init() {
    $Y = 1;
    $X = 0;
    $Angle = 180;

    $sql = "SELECT id FROM map WHERE coordX=:x AND coordY=:y AND direction=:angle AND status_action=1";
    $query = $this->_dbh->prepare($sql);
    $query->bindParam(':y', $Y, PDO::PARAM_INT);
    $query->bindParam(':x', $X, PDO::PARAM_INT);
    $query->bindParam(':angle', $Angle, PDO::PARAM_INT);
    $query->execute();
    $reset = $query->fetch(PDO::FETCH_OBJ);
    if(isset($reset->id) && ($reset->id == 3)) {
        $_SESSION['items'] = 0;

        $sql = "UPDATE actions SET status=0";
        $query = $this->_dbh->prepare($sql);
        $query->execute();

        $sql = "UPDATE map SET status_action=0";
        $query = $this->_dbh->prepare($sql);
        $query->execute();

        $sql = "UPDATE text SET status_action=0";
        $query = $this->_dbh->prepare($sql);
        $query->execute();

        $sql = "UPDATE images SET status_action=0";
        $query = $this->_dbh->prepare($sql);
        $query->execute();
    }
}
// Getter pour la coordonnée X actuelle
public function getCurrentX(){
    return $this->_currentX; // Retourne la coordonnée X actuelle
}
// Setter pour la coordonnée X actuelle
public function setCurrentX($currentX){
    $this->_currentX = $currentX; // Met à jour la coordonnée X
}

// Getter pour la coordonnée Y actuelle
public function getCurrentY(){
    return $this->_currentY; // Retourne la coordonnée Y actuelle
}
// Setter pour la coordonnée Y actuelle
public function setCurrentY($currentY){
    $this->_currentY = $currentY; // Met à jour la coordonnée Y
}

// Getter pour l'angle actuel
public function getCurrentAngle(){
    return $this->_currentAngle; // Retourne l'angle actuel
}
// Setter pour l'angle actuel
public function setCurrentAngle($currentAngle){
    $this->_currentAngle = $currentAngle; // Met à jour l'angle
}

// Getter pour la connexion à la base de données
public function getDbh(){
    return $this->_dbh; // Retourne la connexion à la base de données
}
// Setter pour la connexion à la base de données
public function setDbh($dbh){
    $this->_dbh = $dbh; // Met à jour la connexion à la base de données
}

// Vérifie le déplacement en avant en fonction de l'angle actuel
public function checkForward(){
    $X = $this->_currentX; // Utilisation de la propriété avec 'this' (Rajout 10/03 10:55)
    $Y = $this->_currentY;


    // Selon l'angle, on détermine la nouvelle position
    if($this->_currentAngle == 0){
        $X = ($this->_currentX + 1); // Déplacement vers la droite
        $Y = $this->_currentY;
    } else if($this->_currentAngle == 90){
        $X = $this->_currentX;
        $Y = ($this->_currentY + 1); // Déplacement vers le haut
    } else if($this->_currentAngle == 180){
        $X = ($this->_currentX - 1); // Déplacement vers la gauche
        $Y = $this->_currentY;
    } else if($this->_currentAngle == 270){
        $X = $this->_currentX;
        $Y = ($this->_currentY - 1); // Déplacement vers le bas
    } 

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)

}

// Vérifie le déplacement en arrière en fonction de l'angle actuel
public function checkBack(){
    $X = $this->_currentX; // Utilisation de la propriété avec 'this' (Rajout 10/03 10:55)
    $Y = $this->_currentY;

    // Selon l'angle, on détermine la nouvelle position
    if($this->_currentAngle == 0){
        $X = ($this->_currentX - 1); // Déplacement vers la gauche
        $Y = $this->_currentY;
    } else if($this->_currentAngle == 90){
        $X = $this->_currentX;
        $Y = ($this->_currentY - 1); // Déplacement vers le bas
    } else if($this->_currentAngle == 180){
        $X = ($this->_currentX + 1); // Déplacement vers la droite
        $Y = $this->_currentY;
    } else if($this->_currentAngle == 270){
        $X = $this->_currentX;
        $Y = ($this->_currentY + 1); // Déplacement vers le haut
    } 

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)

}

// Vérifie le déplacement vers la droite en fonction de l'angle actuel
public function checkRight(){
    $X = $this->_currentX; // Utilisation de la propriété avec 'this' (Rajout 10/03 10:55)
    $Y = $this->_currentY;

    // Selon l'angle, on détermine la nouvelle position
    if($this->_currentAngle == 0){
        $Y = ($this->_currentY - 1); // Déplacement vers la droite
        $X = $this->_currentX;
    } else if($this->_currentAngle == 90){
        $Y = $this->_currentY;
        $X = ($this->_currentX + 1); // Déplacement vers la droite
    } else if($this->_currentAngle == 180){
        $Y = ($this->_currentY + 1); // Déplacement vers la gauche
        $X = $this->_currentX;
    } else if($this->_currentAngle == 270){
        $Y = $this->_currentY;
        $X = ($this->_currentX - 1); // Déplacement vers la gauche
    }

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)

}

// Vérifie le déplacement vers la gauche en fonction de l'angle actuel
public function checkLeft(){
    $X = $this->_currentX; // Utilisation de la propriété avec 'this' (Rajout 10/03 10:55)
    $Y = $this->_currentY;
    
    // Selon l'angle, on détermine la nouvelle position
    if($this->_currentAngle == 0){
        $Y = ($this->_currentY + 1); // Déplacement vers la gauche
        $X = $this->_currentX;
    } else if($this->_currentAngle == 90){
        $Y = $this->_currentY;
        $X = ($this->_currentX - 1); // Déplacement vers la gauche
    } else if($this->_currentAngle == 180){
        $Y = ($this->_currentY - 1); // Déplacement vers la droite
        $X = $this->_currentX;
    } else if($this->_currentAngle == 270){
        $Y = $this->_currentY;
        $X = ($this->_currentX + 1); // Déplacement vers la droite
    }

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)
}

// Vérifie la rotation vers la droite
public function checkTurnRight(){
    // Selon l'angle actuel, on effectue la rotation à droite
    if($this->_currentAngle == 0){
        $angleFutur = 270 ; // Si on est face à 0°, on se tourne vers 270° (sud)
    } else {
        $angleFutur = ($this->_currentAngle - 90); // Sinon, on réduit l'angle de 90° (rotation droite)
    }

    return $angleFutur; // Retourne l'angle après la rotation (RAJOUT le 10/03, 10:55)
}

// Vérifie la rotation vers la gauche
public function checkTurnLeft(){
    // Selon l'angle actuel, on effectue la rotation à gauche
    if($this->_currentAngle == 270){
        $angleFutur = 0 ; // Si on est face à 270°, on se tourne vers 0° (nord)
    } else {
        $angleFutur = ($this->_currentAngle + 90); // Sinon, on augmente l'angle de 90° (rotation gauche)
    }

    return $angleFutur; // Retourne l'angle après la rotation (RAJOUT le 10/03, 10:55)
}

// Déplacement vers l'avant en fonction de l'angle actuel
public function goForward(){
    $essai = $this->checkForward(); // Appel de la méthode pour obtenir les nouvelles coordonnées possibles
    if($essai == 1){
        // Déplacement en fonction de l'angle actuel
        if($this->_currentAngle == 0){
            $this->setCurrentX($this->_currentX + 1); // Déplacement vers la droite
        } else if($this->_currentAngle == 90){
            $this->setCurrentY($this->_currentY + 1); // Déplacement vers le haut
        } else if($this->_currentAngle == 180){
            $this->setCurrentX($this->_currentX - 1); // Déplacement vers la gauche
        } else if($this->_currentAngle == 270){
            $this->setCurrentY($this->_currentY -1); // Déplacement vers le bas
        }
    } else {
            error_log("Déplacement impossible vers l'avant : position invalide.");

        }
}

// Déplacement vers l'arrière en fonction de l'angle actuel
public function goBack(){
    $essai = $this->checkBack(); // Appel de la méthode pour obtenir les nouvelles coordonnées possibles
    if($essai == 1){
    // Déplacement en fonction de l'angle actuel
        if($this->_currentAngle == 0){
            $this->setCurrentX($this->_currentX - 1); // Déplacement vers la gauche
        } else if($this->_currentAngle == 90){
            $this->setCurrentY($this->_currentY - 1); // Déplacement vers le bas
        } else if($this->_currentAngle == 180){
            $this->setCurrentX($this->_currentX + 1); // Déplacement vers la droite
        } else if($this->_currentAngle == 270){
            $this->setCurrentY($this->_currentY + 1); // Déplacement vers le haut
        }
    } else {
        error_log("Vous ne pouvez pas reculez!!!!");
    }
}

// Déplacement vers la droite en fonction de l'angle actuel
public function goRight(){
    $essai = $this->checkRight(); // Appel de la méthode pour obtenir les nouvelles coordonnées possibles
    if($essai == 1){
    // Déplacement en fonction de l'angle actuel
        if($this->_currentAngle == 0){
            $this->setCurrentX($this->_currentX + 1); // Déplacement vers la droite
        } else if($this->_currentAngle == 90){
            $this->setCurrentY($this->_currentY - 1); // Déplacement vers le bas
        } else if($this->_currentAngle == 180){
            $this->setCurrentX($this->_currentX - 1); // Déplacement vers la gauche
        } else if($this->_currentAngle == 270){
            $this->setCurrentY($this->_currentY + 1); // Déplacement vers le haut
        }
     } else {
        error_log("vous ne pouvez pas aller à droite!!!";)
     }}

// Déplacement vers la gauche en fonction de l'angle actuel
public function goLeft(){
    $essai = $this->checkLeft(); // Appel de la méthode pour obtenir les nouvelles coordonnées possibles
    if($essai == 1){
        // Déplacement en fonction de l'angle actuel
        if($this->_currentAngle == 0){
            $this->setCurrentX($this->_currentX - 1); // Déplacement vers la gauche
        } else if($this->_currentAngle == 90){
            $this->setCurrentY($this->_currentY + 1); // Déplacement vers le haut
        } else if($this->_currentAngle == 180){
            $this->setCurrentX($this->_currentX + 1); // Déplacement vers la droite
        } else if($this->_currentAngle == 270){
            $this->setCurrentY($this->_currentY - 1); // Déplacement vers le bas
        }
    } else {
        error_log("Vous ne pouvez pas aller à gauche!!!");
    }
}

// Méthode pour effectuer une rotation vers la droite
public function turnRight() {
    // Vérifie si la rotation vers la droite est possible
    $essai = $this->checkTurnRight();
    // Erreur ici : la variable utilisée dans la condition est "$test" au lieu de "$essai"
    if($essai == 1) {  
        // Si l'angle actuel est à 0° (nord), tourner à 270° (ouest)
        if($this->_currentAngle == 0) {
            $this->setCurrentAngle(270);
        } else {
            // Sinon, diminuer l'angle de 90° pour tourner à droite
            $this->setCurrentAngle($this->_currentAngle - 90);
        }
    } else {
        // Si le mouvement n'est pas possible, afficher un message d'erreur
        error_log('Vous ne pouvez pas tourner à droite.');
    }
}

// Méthode pour effectuer une rotation vers la gauche
public function turnLeft() {
    // Vérifie si la rotation vers la gauche est possible
    $essai = $this->checkTurnLeft();

    // Erreur ici : la variable utilisée dans la condition est "$test" au lieu de "$essai"
    if($essai == 1) {  
        // Si l'angle actuel est à 270° (ouest), revenir à 0° (nord)
        if($this->_currentAngle == 270) {
            $this->setCurrentAngle(0);
        } else {
            // Sinon, augmenter l'angle de 90° pour tourner à gauche
            $this->setCurrentAngle($this->_currentAngle + 90);
        }
    } else {
        // Si le mouvement n'est pas possible, afficher un message d'erreur
        error_log('Vous ne pouvez pas tourner à gauche.');
    }
}


?> 