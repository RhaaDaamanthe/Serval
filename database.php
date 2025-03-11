<?php
class Database extends PDO {
    private $host = "localhost";
    private $dbName = "fpview";
    private $username = "root";
    private $password = "root";

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=utf8";
            
            // ✅ Appelle correctement le constructeur parent avec les bons paramètres
            parent::__construct($dsn, $this->username, $this->password);
            
            // Configuration des attributs de PDO
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            // 🔹 Message de confirmation
            // echo "✅ Connexion réussie à la base de données $this->dbName sur $this->host";
        } catch (PDOException $e) {
            echo '❌ Erreur de connexion : ' . $e->getMessage();
        }
    }
}

// Tester la connexion
$db = new Database();
?>
