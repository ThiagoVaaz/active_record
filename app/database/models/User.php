<?php

namespace app\database\models;

use app\database\activeRecord\ActiveRecord;

class User extends ActiveRecord
{
    protected $table = 'users';
    
}