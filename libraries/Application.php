<?php

class Application
{

    public static function process ()
    {
        $controllerName = "Article";
        $task = "index";

        if (!empty($_GET['controller'])) {
            // ucfirst() remplace le premier caractère de la chaîne en majuscule
            $controllerName = ucfirst($_GET['controller']);
        }

        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }

        $controllerName = "\Controllers\\" . $controllerName;

        $controller = new $controllerName();

        $controller->$task();
    }
}