<?php

namespace app\database\interfaces;

use app\database\interfaces\ActiveRecordInterface;

interface UpdateInterface
{
    public function update(ActiveRecordInterface $activeRecordInterface);
}
