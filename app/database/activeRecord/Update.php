<?php

namespace app\database\activeRecord;

use PDOException;
use app\database\connection\Connection;
use app\exceptions\ConnectionException;
use app\database\interfaces\UpdateInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\ActiveRecordExecuteInterface;

class Update implements ActiveRecordExecuteInterface
{
    public function __construct(private string $field, private string|int $value)
    {
    }

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        try {
            $query = $this->createQuery($activeRecordInterface);
            
            $connection = Connection::connect();

            $attributes = array_merge($activeRecordInterface->getAttributes(), [$this->field => $this->value]);

            $prepare = $connection->prepare($query);
            $prepare->execute($attributes);
            return $prepare->rowCount();
        } catch (PDOException $e) {
            throw new ConnectionException();
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        if(array_key_exists('id', $activeRecordInterface->getAttributes())){
            throw new ConnectionException();
        }

        //"update users set firstName - :firstName, lastName = :lastName where id = :id";
        $sql = "update {$activeRecordInterface->getTable()} set ";

        foreach ($activeRecordInterface->getAttributes() as $key => $value) {
                $sql .= "{$key}=:{$key},";
        }
        $sql = rtrim($sql, ',');
        $sql .= " where {$this->field} = :{$this->field}";
        return $sql;
    }
}
