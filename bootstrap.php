<?php

require "vendor/autoload.php";

use app\bind\Bind;
use app\database\connection\Connection;
use app\exceptions\ConnectionException;

$config = require "config.php";

Bind::set('config', $config);
Bind::set('connection', Connection::connect());

try{
    $connection = Connection::connect();
    return $connection;
} catch(PDOException $e){
    throw new ConnectionException(); 
}