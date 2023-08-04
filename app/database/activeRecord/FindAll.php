<?php

namespace app\database\activeRecord;

use PDOException;
use app\database\connection\Connection;
use app\exceptions\ConnectionException;
use app\database\interfaces\UpdateInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\ActiveRecordExecuteInterface;

class FindAll implements ActiveRecordExecuteInterface
{
	public function __construct(
    	private array $where = [],
    	private string|int $limit = '',
    	private string|int $offset = '',
    	private string $fields = '*',
    ) 
    {
    }

	public function execute(ActiveRecordInterface $activeRecordInterface)
	{
		try{
			$query = $this->createQuery($activeRecordInterface);
			
			$connection = Connection::connect();

			$prepare = $connection->prepare($query);
			$prepare->execute($this->where);

			return $prepare->fetchAll();

		}catch(PDOException){
			throw new ConnectionException;
		}
	}

	private function createQuery(ActiveRecordInterface $activeRecordInterface)
	{
		//select * from  users where email = :email
		if(count($this->where) > 1){
			throw new PDOException;
		}

		$where = array_keys($this->where);

		$sql = "select {$this->fields} from {$activeRecordInterface->getTable()}";
		$sql.= (!$this->where) ? '' : " where {$where[0]} = :{$where[0]}";
		$sql.= (!$this->limit) ? '' : " limit {$this->limit}";
		$sql.= ($this->offset != '') ? " offset {$this->offset}" : "";

		return $sql;
	}
}
