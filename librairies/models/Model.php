<?php

namespace Models;

require_once('librairies/database.php');

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getPdo();
    }    


    /**
     * Return one by id if found, else return false
     * 
     * @param int $id
     * 
     * @return array|bool 
     */
    public function findbyId (int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
    
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
    
        // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();
    
        return $item;
    }
    
    /**
     * Return all articles sorted by creation date
     * 
     * @return array
     */
    public function findAll (?string $order = ""): array
    {
        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
            $sql .=  " ORDER BY " . $order;
        }
        
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();
        return $articles;
    }

    /**
     * Return all comments for on article
     * 
     * @param int article id
     * 
     * @return array
     */
    public function findAllForArticle (int $id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
    }


    /**
     * Delete
     * 
     * @param int Comment id
     * 
     * @return void
     */
    public function delete (int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

}