<?php
require '../bootstrap.php';

use app\database\activeRecord\Insert;
use app\database\models\User;
use app\database\activeRecord\Update;
use app\database\connection\Connection;
use app\database\activeRecord\UpdateUser;

//var_dump(Connection::connect()) ;

$user = new User;
$user->firstName = 'Thiago';
$user->lastName = 'Vaz';
$user->id = 1;

echo $user->execute(new Update);