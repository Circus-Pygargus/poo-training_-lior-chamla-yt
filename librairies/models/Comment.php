<?php

namespace Models;

require_once('librairies/models/Model.php');


class Comment extends Model
{

    protected $table = "comments";

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
}