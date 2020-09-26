<?php

require_once('librairies/models/Model.php');


class Comment extends Model
{

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
     * Find a comment
     * 
     * @param int Comment id
     * 
     * @return array|bool  return array if found, else return false
     */
    public function findOne (int $id)
    {    
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        if ($query->rowCount() === 0) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        $commentaire = $query->fetch();

        return $commentaire;
    }


    /**
     * Save a comment
     * 
     * @param string $author
     * @param string $content
     * @param int $article_id
     * 
     * @return void
     */
    public function saveOne (string $author, string $content, int $article_id): void
    {   
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }


    /**
     * Delete a comment
     * 
     * @param int Comment id
     * 
     * @return void
     */
    public function delete (int $id): void
    {
        $query = $this->pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}