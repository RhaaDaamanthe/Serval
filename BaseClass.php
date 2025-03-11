<?php

// Classe de base contenant les coordonnées, l'angle et la connexion à la base de données
class BaseClass {
    private $_currentX; // Coordonnée X actuelle
    private $_currentY; // Coordonnée Y actuelle
    private $_currentAngle; // Angle de vue actuel (0, 90, 180, 270)
    private $_dbh; // Connexion à la base de données
}

// Constructeur qui initialise les propriétés de la classe
public function __construct($currentX, $currentY, $currentAngle,$dbh){
    $this->_currentX = $currentX; // Initialisation de la coordonnée X
    $this->_currentY = $currentY; // Initialisation de la coordonnée Y
    $this->_currentAngle = $currentAngle; // Initialisation de l'angle de vue
    $this->_dbh = $dbh; // Initialisation de la connexion à la base de données
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
    if($_currentAngle == 0){
        $X = ($_currentX + 1); // Déplacement vers la droite
        $Y = $_currentY;
    } else if($_currentAngle == 90){
        $X = $_currentX;
        $Y = ($_currentY + 1); // Déplacement vers le haut
    } else if($_currentAngle == 180){
        $X = ($_currentX - 1); // Déplacement vers la gauche
        $Y = $_currentY;
    } else if($_currentAngle == 270){
        $X = $_currentX;
        $Y = ($_currentY - 1); // Déplacement vers le bas
    } 

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)

}

// Vérifie le déplacement en arrière en fonction de l'angle actuel
public function checkBack(){
    $X = $this->_currentX; // Utilisation de la propriété avec 'this' (Rajout 10/03 10:55)
    $Y = $this->_currentY;

    // Selon l'angle, on détermine la nouvelle position
    if($_currentAngle == 0){
        $X = ($_currentX - 1); // Déplacement vers la gauche
        $Y = $_currentY;
    } else if($_currentAngle == 90){
        $X = $_currentX;
        $Y = ($_currentY - 1); // Déplacement vers le bas
    } else if($_currentAngle == 180){
        $X = ($_currentX + 1); // Déplacement vers la droite
        $Y = $_currentY;
    } else if($_currentAngle == 270){
        $X = $_currentX;
        $Y = ($_currentY + 1); // Déplacement vers le haut
    } 

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)

}

// Vérifie le déplacement vers la droite en fonction de l'angle actuel
public function checkRight(){
    $X = $this->_currentX; // Utilisation de la propriété avec 'this' (Rajout 10/03 10:55)
    $Y = $this->_currentY;

    // Selon l'angle, on détermine la nouvelle position
    if($_currentAngle == 0){
        $Y = ($_currentY - 1); // Déplacement vers la droite
        $X = $_currentX;
    } else if($_currentAngle == 90){
        $Y = $_currentY;
        $X = ($_currentX + 1); // Déplacement vers la droite
    } else if($_currentAngle == 180){
        $Y = ($_currentY + 1); // Déplacement vers la gauche
        $X = $_currentX;
    } else if($_currentAngle == 270){
        $Y = $_currentY;
        $X = ($_currentX - 1); // Déplacement vers la gauche
    }

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)

}

// Vérifie le déplacement vers la gauche en fonction de l'angle actuel
public function checkLeft(){
    $X = $this->_currentX; // Utilisation de la propriété avec 'this' (Rajout 10/03 10:55)
    $Y = $this->_currentY;
    
    // Selon l'angle, on détermine la nouvelle position
    if($_currentAngle == 0){
        $Y = ($_currentY + 1); // Déplacement vers la gauche
        $X = $_currentX;
    } else if($_currentAngle == 90){
        $Y = $_currentY;
        $X = ($_currentX - 1); // Déplacement vers la gauche
    } else if($_currentAngle == 180){
        $Y = ($_currentY - 1); // Déplacement vers la droite
        $X = $_currentX;
    } else if($_currentAngle == 270){
        $Y = $_currentY;
        $X = ($_currentX + 1); // Déplacement vers la droite
    }

    return [$X, $Y]; // Retourne les nouvelles coordonnées , (RAJOUT 10/03 10:55)
}

// Vérifie la rotation vers la droite
public function checkTurnRight(){
    // Selon l'angle actuel, on effectue la rotation à droite
    if($_currentAngle == 0){
        $angleFutur = 270 ; // Si on est face à 0°, on se tourne vers 270° (sud)
    } else {
        $angleFutur = ($_currentAngle - 90); // Sinon, on réduit l'angle de 90° (rotation droite)
    }

    return $angleFutur; // Retourne l'angle après la rotation (RAJOUT le 10/03, 10:55)
}

// Vérifie la rotation vers la gauche
public function checkTurnLeft(){
    // Selon l'angle actuel, on effectue la rotation à gauche
    if($_currentAngle == 270){
        $angleFutur = 0 ; // Si on est face à 270°, on se tourne vers 0° (nord)
    } else {
        $angleFutur = ($_currentAngle + 90); // Sinon, on augmente l'angle de 90° (rotation gauche)
    }

    return $angleFutur; // Retourne l'angle après la rotation (RAJOUT le 10/03, 10:55)
}

// Méthode privée pour vérifier la possibilité de déplacement vers une position cible (à compléter)
private function checkMove($X, $cY, $Angle){
    // Cette méthode doit interroger la base de données et vérifier que le déplacement vers la position cible est valide.
    // Elle pourrait renvoyer true si le mouvement est possible, false sinon.
}

// Modifier par Alex le 11/03/25 en direct live de la salle a manger avec les fous du bus
?>  