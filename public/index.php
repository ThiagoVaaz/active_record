<?php
require '../bootstrap.php';

use app\database\models\User;
use app\database\activeRecord\FindBy;
use app\database\activeRecord\FindAll;
use app\database\activeRecord\Insert;
use app\database\activeRecord\Update;
use app\database\activeRecord\Delete;
use app\database\connection\Connection;
use app\database\activeRecord\UpdateUser;

//var_dump(Connection::connect()) ;

$user = new User;
$user->firstName = 'Thiago';
$user->lastName = 'Vaz';
//$user->email = 'thiago@thiago.com';

var_dump($user->execute(New FindAll(fields:'firstName,lastName')));