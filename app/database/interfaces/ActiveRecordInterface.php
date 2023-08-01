<?php

namespace app\database\interfaces;

use app\database\interfaces\InsertInterface;
use app\database\interfaces\UpdateInterface;

interface ActiveRecordInterface
{
    public function execute(ActiveRecordExecuteInterface $activeRecordExecuteInterface);     
    public function getTable();

    public function getAttributes();
    public function __set($attribute, $value);
    public function __get($attribute);
}