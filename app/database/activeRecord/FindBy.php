<?php

namespace app\database\activeRecord;

use PDOException;
use app\database\connection\Connection;
use app\exceptions\ConnectionException;
use app\database\interfaces\UpdateInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\ActiveRecordExecuteInterface;

class FindBy implements ActiveRecordExecuteInterface
{
	public function __construct(private string $field, private string|int $value, private string $fields = '*')
	{
	}

	public function execute(ActiveRecordInterface $activeRecordInterface)
	{
		try{
			$query = $this->createQuery($activeRecordInterface);
			
			$connection = Connection::connect();

			$prepare = $connection->prepare($query);
			$prepare->execute([
				$this->field => $this->value
			]);

			return $prepare->fetch();
		}catch(PDOException){
			throw new ConnectionException;
		}
	}

	private function createQuery(ActiveRecordInterface $activeRecordInterface)
	{
		//select * from  users where id = :id
		$sql = "select {$this->fields} from {$activeRecordInterface->getTable()} where {$this->field} = :{$this->field}";
		return $sql;
	}
}
