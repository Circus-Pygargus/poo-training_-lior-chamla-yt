<?php

class Database
{

    /**
     * Return a database connection
     * 
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=pooliorchamla;charset=utf8', 'root', 'online@2017', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }
}