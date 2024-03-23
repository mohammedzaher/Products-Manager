<?php

namespace App\Core;

use PDO;

class Database
{
    private static $bdd = null;

    public static function getBdd()
    {
        $env = parse_ini_file(ROOT . '.env');

        if(self::$bdd === null) {
            $dsn = "mysql:host=$env[DB_HOST];dbname=$env[DB_NAME];";
            self::$bdd = new PDO($dsn, $env['DB_USER'], $env['DB_PASSWORD'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
             ]);
        }

        return self::$bdd;
    }
}
