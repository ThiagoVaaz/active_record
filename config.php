<?php

return [
    'database' => [
        'host' => 'localhost',
        'dbname' => 'activerecord',
        'username' => 'postgres',
        'password' => 'root',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ],
    ],
];