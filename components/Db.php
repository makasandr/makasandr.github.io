            $pass = $_SESSION['pass'];<?php

/**
 * Component for working with Data Base
 */
class Db
{

    /**
     * Connecting to DB
     */
    public static function getConnection()
    {
        // Getting parameters from file
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        // Setting connection
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        $db->exec("set names utf-8");

        return $db;
    }

}
