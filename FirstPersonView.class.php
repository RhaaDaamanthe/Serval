<?php
class firstPersonView extends BaseClass{
    // Constante indiquant le répertoire des images
    const IMAGE_DIRECTORY = "./images/";

    // Propriété privée pour l'identifiant de la carte
    private $_mapId;

    // Constructeur de la classe
    public function contruct($currentX, $currentY, $currentAngle, $dbh, $mapId){
        // Appel au constructeur de la classe parente
        parent::construct($currentX, $currentY, $currentAngle, $dbh);

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




// Méthode pour obtenir le chemin complet de l'image associée à la carte
public function getView(){
    // Utilisation de la constante IMAGE_DIRECTORY pour retourner le chemin de l'image
return self::IMAGE_DIRECTORY . $this->_mapId . '.jpg';
}}

?>