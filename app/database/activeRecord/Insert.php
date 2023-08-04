<?php

namespace app\database\activeRecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\InsertInterface;

class Insert implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        try{
            $query = $this->createQuery($activeRecordInterface);
            
            $connection = Connection::connect();

            $prepare = $connection->prepare($query);
            return $prepare->execute($activeRecordInterface->getAttributes());
        }catch(PDOException $e){
            throw new ConnectionException;
        }

    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        //"insert into users (firstName, lastName) values(:firstName, :lastName, emaiil)";
        $sql = "insert into {$activeRecordInterface->getTable()}(";
        $sql.= implode(',', array_keys($activeRecordInterface->getAttributes())).')' . ' values(';
        $sql.=':'.implode(',:', array_keys($activeRecordInterface->getAttributes())).')';
        return $sql;
    }
}

