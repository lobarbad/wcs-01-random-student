<?php

class MyDB

{
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'wcs_draw_random_student';

    private static $pdo;

    private function __construct() // pattern singleton
    {
    }

    public static function getPDOInstance(): PDO
    {
        if (self::$pdo === NULL) {
            self::$pdo = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=UTF8',
                self::DB_USER,
                self::DB_PASS,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "utf8"',
                    PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE,
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_STRINGIFY_FETCHES  => FALSE,
                    PDO::ATTR_EMULATE_PREPARES   => FALSE,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS
                ]);
        }
        return self::$pdo;
    }
}