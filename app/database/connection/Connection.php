<?php

namespace app\database\connection;

use PDO;
use app\bind\Bind;
use app\exceptions\ConnectionException;

class Connection
{
    private static $pdo = null;

    public static function connect()
    {

        if (static::$pdo) {
            throw new ConnectionException('A conexão já foi estabelecida');
        }
        $config = (object) Bind::get('config')->database;
        $pdo = new PDO("mysql:host=$config->host;dbname=$config->dbname;charset=$config->charset", $config->username, $config->password, $config->options);
        return $pdo;
    }   
}
