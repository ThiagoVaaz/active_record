<?php

namespace app\database\activeRecord;

use PDOException;
use app\database\connection\Connection;
use app\exceptions\ConnectionException;
use app\database\interfaces\UpdateInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\ActiveRecordExecuteInterface;

class Delete implements ActiveRecordExecuteInterface
{
	public function __construct(private string $field, private string|int $value)
	{
	}

	public function execute(ActiveRecordInterface $activeRecordInterface)
	{
		//delete from users where id  = :id
		try{
			$query = $this->createQuery($activeRecordInterface);

			$connection = Connection::connect();

			$prepare = $connection->prepare($query);
			$prepare->execute([
				$this->field => $this->value
			]);

			return $prepare->rowCount();
		}catch(PDOException){
			throw new ConnectionException;
		}
	}

	private function createQuery(ActiveRecordInterface $activeRecordInterface)
	{
		if($activeRecordInterface->getAttributes()){
			throw new PDOException('Para deletar não precisa passar atributos');
		}
		$sql = "delete from {$activeRecordInterface->getTable()}";
		$sql .= " where {$this->field} = :{$this->field}";

		return $sql;
	}
}
