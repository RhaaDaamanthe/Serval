<?php
class FirstPersonText extends BaseClass{
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
        // Récupération des coordonnées et de l'angle actuels
        $Y = $this->getcurrentY();
        $X = $this->getCurrentX();
        $Angle = $this->getCurrentAngle();
        
        // Requête SQL pour trouver l'identifiant de la carte en fonction des coordonnées et de l'angle
        $sql = "SELECT id FROM map WHERE coordX=:x AND coordY=:y AND direction=:angle";
        $query = $this->getDbh()->prepare($sql);

        // Lien des paramètres à la requête SQL
        $query->bindParam(':y', $Y, PDO::PARAM_INT);
        $query->bindParam(':x', $X, PDO::PARAM_INT);
        $query->bindParam(':angle', $Angle, PDO::PARAM_INT);

        // Exécution de la requête
        $query->execute();
        // Récupération du résultat de la requête
        $newPos = $query->fetch(PDO::FETCH_OBJ);
        // Mise à jour de l'identifiant de la carte
        $this->setMapId($newPos->mapId);
    }

    // Méthode publique pour récupérer le texte associé à l'identifiant de la cart
    public function getText(){
        // Mise à jour de l'identifiant de la carte avant de récupérer le texte
        $this->__currentMapId();

        $dbh = $this->getDbh();// Récupération de la connexion à la base de données

        // Requête SQL pour obtenir le texte associé à la carte
        $sql = "SELECT text.text FROM text JOIN map ON map.id=text.`map id`=:map WHERE map.id = :map";
        $query = $dbh->prepare($sql);

        $query->bindParam(':map', $this->_mapId, PDO::PARAM_INT);  // Lien du paramètre de la requête
        $query->execute();// Exécution de la requête
        $view = $query->fetch(PDO::FETCH_OBJ); // Récupération du résultat de la requête

        // Vérification si un texte a été trouvé
        if(isset($view->text)) {
            $text = $view->text; // Si oui, assignation du texte
        } else {
            $text = "Il n'y a rien ici..."; // Message par défaut si aucun texte n'est trouvé
        }
        
        // Retourne le texte récupéré
        return $text;

    }
}
?>