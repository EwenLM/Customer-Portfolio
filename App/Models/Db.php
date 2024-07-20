<?php

namespace App\Models;

use PDO;
use PDOException;

class Db
{
    private static $instance;
    protected $pdo;

    protected function __construct()
    {
        // Récupération des valeurs à partir des variables d'environnement
        $dbhost = $_ENV['DBHOST'] ?? 'localhost';
        $dbuser = $_ENV['DBUSER'] ?? 'root';
        $dbpass = $_ENV['DBPASS'] ?? '';
        $dbname = $_ENV['DBNAME'] ?? 'custommer';
    
        // DSN de connexion
        $dsn = 'mysql:dbname=' . $dbname . ';host=' . $dbhost;
    
        // On appelle le constructeur de la classe PDO
        try {
            $this->pdo = new PDO($dsn, $dbuser, $dbpass);
    
            $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8mb4');
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Méthode pour récupérer l'instance de PDO
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    // Méthode pour récupérer l'instance de la classe Db
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

// Utilisation la classe Db pour obtenir une instance de PDO
try {
    $db = Db::getInstance()->getPdo();
    // Utilisation de $db pour effectuer des opérations sur la base de données
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
