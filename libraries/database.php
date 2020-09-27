<?php

class Database
{

    private static $instance = null;

    /**
     * Return a database connection
     * 
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        // on utilise self:: pour appeler une propriété static de cette classe
        if (self::$instance === null) {
            self::$instance = new PDO('mysql:host=localhost;dbname=pooliorchamla;charset=utf8', 'root', 'online@2017', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        
        return self::$instance;
    }
}