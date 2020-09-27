<?php

class Renderer
{
    /**
     * return completed templates
     * 
     * @param String $title
     * @param String $template Template 
     * 
     * @return void
     */
    public static function render(string $path, array $variables = []) {

        // here we create variables with associated array content
        extract($variables);

        ob_start();
        require('templates/'. $path .'.html.php');
        $pageContent = ob_get_clean();

        require('templates/layout.html.php');
    }
}