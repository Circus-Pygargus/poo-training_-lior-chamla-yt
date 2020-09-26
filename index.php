<?php

/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * 
 * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien (SELECT * FROM articles ORDER BY created_at DESC)
 * puis on va boucler dessus pour afficher chacun d'entre eux
 */

require_once('librairies/database.php');
require_once('librairies/utils.php');
require_once('librairies/models/Article.php');

$model = new Article();

/**
 * 2. Récupération des articles
 */
$articles = $model->findAll("created_at DESC");

/**
 * 3. Affichage
 */
$pageTitle = "Accueil";
// compact() will build an associative array where ['pageTitle' => $pageTitle, 'articles' => $articles] 
render('articles/index', compact('pageTitle', 'articles'));