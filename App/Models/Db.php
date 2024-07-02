<?php

namespace App\Models;

use PDO;
use PDOException;

abstract class Db
{
    protected $pdo;

    protected function __construct()
    {
        // Récupération des valeurs à partir des variables d'environnement
        $dbhost = $_ENV['DBHOST'] ?? 'localhost';
        $dbuser = $_ENV['DBUSER'] ?? 'root';
        $dbpass = $_ENV['DBPASS'] ?? '';
        $dbname = $_ENV['DBNAME'] ?? 'customer';
    
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
}