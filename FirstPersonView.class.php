<?php
class firstPersonView extends BaseClass{
    // Constante indiquant le répertoire des images
    const IMAGE_DIRECTORY = "./images/";

    // Propriété privée pour l'identifiant de la carte
    private $_mapId = 1;

    // Constructeur de la classe
    public function __construct($currentX, $currentY, $currentAngle, $dbh, $mapId){
        // Appel au constructeur de la classe parente
        parent::__construct($currentX, $currentY, $currentAngle, $dbh);

        //Initialisation de l'identifiant de la carte
        $this->_mapId = $mapId;
}
// Getter pour récupérer l'identifint de la carte
public function getMapId(){
    return $this->_mapId;
}
// Setter pour définir l'identifiant de la carte
public function setMapId($mapId){
    $this->_mapId = $mapId;
}

// Méthode privée pour mettre à jour l'identifiant de la carte en fonction des coordonnées et de l'angle
private function __currentMapId(){
    // Récupération des coordonnées Y, X, et de l'angle actuel de la position
    $Y = $this->getcurrentY();   // Récupère la coordonnée Y
    $X = $this->getCurrentX();   // Récupère la coordonnée X
    $Angle = $this->getCurrentAngle();   // Récupère l'angle actuel

    // Requête SQL pour rechercher l'id de la carte basée sur les coordonnées et l'angle
    $sql = "SELECT id FROM map WHERE coordX=:x AND coordY=:y AND direction=:angle";
    $query = $this->getDbh()->prepare($sql);   // Prépare la requête SQL pour l'exécution

    // Lien des paramètres de la requête avec les valeurs de coordonnées et de direction
    $query->bindParam(':y', $Y, PDO::PARAM_INT);   // Lien de la coordonnée Y
    $query->bindParam(':x', $X, PDO::PARAM_INT);   // Lien de la coordonnée X
    $query->bindParam(':angle', $Angle, PDO::PARAM_INT);   // Lien de l'angle
    
    $query->execute(); // Exécution de la requête
    $newPos = $query->fetch(PDO::FETCH_OBJ); // Récupère le résultat sous forme d'objet
    $this->setMapId($newPos->mapId); // Mise à jour de l'identifiant de la carte avec la nouvelle valeur récupérée
}


// Méthode pour obtenir le chemin complet de l'image associée à la carte
public function getView(){
    $this->__currentMapId(); // Mise à jour de l'identifiant de la carte avant d'effectuer la recherche de l'image
    $dbh = $this->getDbh(); // Récupération de la connexion à la base de données
    $sql = "SELECT images.path FROM images JOIN map ON map.id=images.`map id` WHERE images.`map id`=:map"; // Requête SQL pour récupérer le chemin de l'image associé à la carte
    $query = $this->getDbh()->prepare($sql);   // Prépare la requête SQL
    $query->bindParam(':map', $this->_mapId, PDO::PARAM_INT); // Lien de la valeur de l'identifiant de la carte à la requête
    $query->execute(); // Exécution de la requête
    $view = $query->fetch(PDO::FETCH_OBJ); // Récupère le chemin de l'image associé à la carte
    $path = $view->path; // Récupère le chemin de l'image
    return self::IMAGE_DIRECTORY . $path;// Retourne le chemin complet de l'image en concaténant le répertoire d'images avec le chemin récupéré
}

}

?>