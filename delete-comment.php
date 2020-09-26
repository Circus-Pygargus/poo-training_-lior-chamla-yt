<?php

/**
 * DANS CE FICHIER ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !
 * 
 * On va donc vérifier que le paramètre "id" est bien présent en GET, qu'il correspond bien à un commentaire existant
 * Puis on le supprimera !
 */

require_once('librairies/database.php');
require_once('librairies/utils.php');
require_once('librairies/models/Comment.php');

/**
 * 1. Récupération du paramètre "id" en GET
 */

$id = $_GET['id'];

$model = new Comment()
;
$commentaire = $model->findOne($id);

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$article_id = $commentaire['article_id'];

$model->delete($id);

/**
 * 5. Redirection vers l'article en question
 */
redirect("article.php?id=" . $article_id);