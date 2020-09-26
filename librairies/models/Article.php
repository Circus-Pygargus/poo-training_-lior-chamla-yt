<?php

require_once('librairies/models/Model.php');

class Article extends Model
{
    
    /**
     * Return all articles sorted by creation date
     * 
     * @return array
     */
    public function findAll (): array
    {
        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();
        return $articles;
    }


    /**
     * Return one article if found, else return false
     * 
     * @param int $id
     * 
     * @return array|bool 
     */
    public function findOne (int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
    
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['article_id' => $id]);
    
        // On fouille le résultat pour en extraire les données réelles de l'article
        $article = $query->fetch();
    
        return $article;
    }


    /**
     * Delete an article
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete (int $id): void
    {
        /**
         * 2. Connexion à la base de données avec PDO
         * Attention, on précise ici deux options :
         * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
         * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
         * 
         * PS : Vous remarquez que ce sont les mêmes lignes que pour l'index.php ?!
         */  
        
        $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}