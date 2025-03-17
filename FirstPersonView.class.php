<?php
class firstPersonView extends BaseClass{
    // Constante indiquant le répertoire des images
    const IMAGE_DIRECTORY = "./images/";

    // Propriété privée pour l'identifiant de la carte
    private $_mapId;

    // Constructeur de la classe
    public function __contruct($currentX, $currentY, $currentAngle, $dbh, $mapId){
        // Appel au constructeur de la classe parente
        parent::__construct($currentX, $currentY, $currentAngle, $dbh);

        //Initialisation de l'identifiant de la carte
        $this->_mapId = $mapId;
}
// Getter pour récupérer l'identifint de la carte
public function getMapId(){
    return $this->_mapid;
}
// Setter pour définir l'identifiant de la carte
public function setMapId($mapId){
    $this->_mapId = $mapId;
}

private function __currentMapIs(){
    $Y = $this->getcurrentY();
    $X = $this->getCurrentX();
    $Angle = $this->getCurrentAngle();

    $sql = "SELECT id FROM map WHERE coordX=:x AND coordY=:y AND direction=:angle";
    $query = $this->getDbh()->prepare($sql);
    $query->bindParam(':y', $y, PDO::PARAM_INT);
    $query->bindParam(':x', $x, PDO::PARAM_INT);
    $query->bindParam(':angle', $Angle, PDO::PARAM_INT);
    $query->execute();
    $newPos = $query->fetch(PDO::FETCH_OBJ);
    $this->setMapId($newPos->mapId);
}




// Méthode pour obtenir le chemin complet de l'image associée à la carte
public function getView(){
    $this->__currentMapId();
    $dbh = $this->getDbh();
    $sql = "SELECT images.path FROM images JOIN map ON map.id=images.`map id` WHERE images.`map id`=:map";
    $query = $this->getDbh()->prepare($sql);
    $query->bindParam(':map', $this->_mapId, PDO::PARAM_INT);
    $query->execute();
    $view = $query->fetch(PDO::FETCH_OBJ);
    $path = $view->path;
    return self:: IMAGE_DIRECTORY . $path;
}
}

?>