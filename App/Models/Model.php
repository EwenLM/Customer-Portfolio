<?php

namespace App\Models;

use PDOException;

class Model
{
    protected $table;
    protected $params;
    private $db;


    /**
     * constructeur de Model utilisé par les enfants
     * prend en argument le nom de la table et ses params (constitué du nom des colonnes et les valeurs à ajouter)
     *
     * @param [type] $table
     * @param array $params
     */
    public function __construct($table, array $params)
    {
        $this->params = $params;
        $this->table = $table;
        $this->db = Connector::getInstance()->getPdo();
    }


    /**
     * Méthode pour exécuter des requêtes SQL avec préparation et exécution
     * @param string $sql Requête SQL à exécuter
     * @param array|null $attributes Attributs à ajouter à la requête
     * @return \PDOStatement|false Retourne l'objet PDOStatement représentant le résultat de la requête ou false en cas d'erreur
     */
    protected function query(string $sql, ?array $attributes = null)
    {
        try {
            if ($attributes !== null) {
                $query = $this->db->prepare($sql);
                $query->execute($attributes);
                return $query;
            } else {
                return $this->db->prepare($sql);
            }
        } catch (PDOException $e) {
            throw new \Exception("Erreur de requête: " . $e->getMessage());
        }
    }


    // ==========================Méthodes de lecture des données==============================
    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll()
    {
        $query = $this->query('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }
    

    /**
     * Sélection de plusieurs enregistrements suivant un tableau de critères
     * @param array $criteria Tableau de critères
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $criteria)
    {
        $fields = [];
        $values = [];
    
        // Boucle pour "éclater le tableau"
        foreach ($criteria as $field => $value) {
            $fields[] = "$field LIKE ?";
            $values[] = $value;
        }
    
        // Convertit le tableau en une chaîne de caractères séparée par des caractères AND
        $fieldsList = implode(' AND ', $fields);
        $result = $this->query("SELECT * FROM {$this->table} WHERE $fieldsList", $values)->fetchAll();
        
        // Debug: Log or echo the result
        error_log(print_r($result, true));
        
        return $result;
    }
    


    /**
     * Sélection d'un enregistrement suivant son id
     * @param int $id id de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function find(int $id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id])->fetch();
    }


    //============================Méthodes d'insertion de données================================= 
    /**
     * Insertion d'un enregistrement suivant un tableau de données
     * @param Model $model Objet à créer
     * @return bool
     */
    public function create(Model $model)
    {
        $fields = [];
        $placeholders = [];
        $values = [];

        foreach ($model->params as $field => $value) {
            if ($value !== null) {
                $fields[] = $field;
                $placeholders[] = "?";
                $values[] = $value;
            }
        }

        $fieldsList = implode(', ', $fields);
        $placeholdersList = implode(', ', $placeholders);

        return $this->query('INSERT INTO ' . $this->table . ' (' . $fieldsList . ') VALUES (' . $placeholdersList . ')', $values);
    }


    /**
     * Mise à jour d'un enregistrement suivant un tableau de données
     * @param int id de l'enregistrement à modifier
     * @param Model $model Objet à modifier
     * @return bool
     */
    public function update(int $id, Model $model)
    {
        $fields = [];
        $values = [];
        // Boucle pour éclater le tableau
        foreach ($model->params as $field => $value) {
            if ($value !== null) {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
        }
        $values[] = $id;
        // Convertit le tableau "fields" en une chaîne de caractères
        $fieldsList = implode(', ', $fields);
        return $this->query('UPDATE ' . $this->table . ' SET ' . $fieldsList . ' WHERE id = ?', $values);
    }


    /**
     * Suppression d'un enregistrement
     * @param int $id id de l'enregistrement à supprimer
     * @return bool 
     */
    public function delete(int $id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }
}
