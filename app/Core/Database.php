<?php

namespace App\Core;

use MongoDB\Client;

class Database {
    private static $client;
    private static $database;

    public static function getClient() {
        if (!self::$client) {
            $config = require __DIR__ . '/../../config/database.php';
            self::$client = new Client($config['uri']);
        }
        return self::$client;
    }

    public static function getDatabase() {
        if (!self::$database) {
            $config = require __DIR__ . '/../../config/database.php';
            self::$database = self::getClient()->selectDatabase($config['database']);
        }
        return self::$database;
    }
}
