<?php

namespace app\database\activeRecord;

use app\database\connection\Connection;
use PDOException;
use app\database\interfaces\UpdateInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\exceptions\ConnectionException;

class Update implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        try {
            $query = $this->createQuery($activeRecordInterface);
            
            $connection = Connection::connect();

            $prepare = $connection->prepare($query);
            $prepare->execute($activeRecordInterface->getAttributes());
            return $prepare->rowCount();
        } catch (PDOException $e) {
            throw new ConnectionException();
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        //"update users set firstName - :firstName, lastName = :lastName where id = :id";
        $sql = "update {$activeRecordInterface->getTable()} set ";

        foreach ($activeRecordInterface->getAttributes() as $key => $value) {
            if ($key !== 'id') {
                $sql .= "{$key}=:{$key},";
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= " where id = :id";
        return $sql;
    }
}
