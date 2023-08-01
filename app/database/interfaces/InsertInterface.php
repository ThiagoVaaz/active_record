<?php

namespace app\database\interfaces;

use app\database\interfaces\ActiveRecordInterface;

interface InsertInterface
{
    public function insert(ActiveRecordInterface $activeRecordInterface);
}