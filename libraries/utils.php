<?php

/**
 * return completed templates
 * 
 * @param String $title
 * @param String $template Template 
 */
function render(string $path, array $variables = []) {

    // here we create variables with associated array content
    extract($variables);

    ob_start();
    require('templates/'. $path .'.html.php');
    $pageContent = ob_get_clean();

    return require('templates/layout.html.php');
}



function redirect(string $url):void
{
    header("Location: $url");
    exit();
}