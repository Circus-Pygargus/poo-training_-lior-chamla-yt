<?php

/**
 * Return a database connection
 * 
 * @return PDO
 */
function getPdo(): PDO
{
    $pdo = new PDO('mysql:host=localhost;dbname=pooliorchamla;charset=utf8', 'root', 'online@2017', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
}

/**
 * Return all articles sorted by creation date
 * 
 * @return array
 */
function findAllArticles (): array
{
    $pdo = getPdo();
    // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
    // On fouille le résultat pour en extraire les données réelles
    $articles = $resultats->fetchAll();
    return $articles;
}

/**
 * Return one article
 * 
 * @param int $article_id
 * 
 * @return array
 */
function findArticle (int $id)
{
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

    // On exécute la requête en précisant le paramètre :article_id 
    $query->execute(['article_id' => $id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();

    return $article;
}


/**
 * Return all comments for on article
 * 
 * @param int article id
 * 
 * @return array
 */
function findAllComments (int $id): array
{
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
    $query->execute(['article_id' => $id]);
    $commentaires = $query->fetchAll();

    return $commentaires;
}



function deleteArticle (int $id): void
{
    /**
     * 2. Connexion à la base de données avec PDO
     * Attention, on précise ici deux options :
     * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
     * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
     * 
     * PS : Vous remarquez que ce sont les mêmes lignes que pour l'index.php ?!
     */
    $pdo = getPdo();

    
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}


function saveComment (string $author, string $content, int $article_id): void
{   
    $pdo = getPdo();
    $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
    $query->execute(compact('author', 'content', 'article_id'));
}


/**
 * Find a comment
 * 
 * @param int Comment id
 * 
 * @return array
 */
function findComment (int $id)
{    
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
    if ($query->rowCount() === 0) {
        die("Aucun commentaire n'a l'identifiant $id !");
    }

    $commentaire = $query->fetch();

    return $commentaire;
}


/**
 * Delete a comment
 * 
 * @param int Comment id
 * 
 * @return void
 */
function deleteComment (int $id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
}