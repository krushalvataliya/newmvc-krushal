<?php 
class Model_Core_Table_Resource
{
	public $tableName = null;
	public $primaryKey = null;
	public $adapter = null;

	public function __construct()
	{
		
	}

	public function getAdapter()
	{
		if($this->adapter)
		{
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

    public function getResourceName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function fetchAll($query = null)
	{
		if($query == null)
		{
			$query ="SELECT * FROM `{$this->getResourceName()}`";
		}

		return $this->getAdapter()->fetchAll($query);
	}

	public function fetchRow($query)
	{
		return $this->getAdapter()->fetchRow($query);
	}	

	public function load($id)
	{
		$adapter = $this->getAdapter();
		$query = 'SELECT * FROM `'.$this->getResourceName().'` WHERE `'.$this->getPrimaryKey().'` = "'.$id.'"';
		$result = $adapter->fetchRow($query);
		return $result;
	}

	public function insert($data)
	{	
		if(is_array($data))
		{
			$key =  implode('`,`', array_keys($data));
			$value =  implode('\',\'', $data);
		}

		$sql = "INSERT INTO `{$this->tableName}` (`{$key}`) VALUES ('{$value}')";
		$result = $this->getAdapter()->insert($sql);
		return $result;

	}

	public function insertUpdateOnDuplicate(array $data,array $uniqueColumns)
	{
		$key =  implode('`,`', array_keys($data));
		$value =  implode('\',\'', $data);

		$updateValue = array_diff($data,$uniqueColumns);

		foreach ($updateValue as $key1 => $value1)
		{
			$values [] =" `{$key1}` = '{$value1}'" ;
		}
		$sql = "INSERT INTO `{$this->tableName}` (`{$key}`) VALUES ('{$value}') ON DUPLICATE KEY UPDATE ".implode(',', $values);
		$result = $this->getAdapter()->query($sql);
		return $result;
	}

	public function update($data,$condition)
	{
		foreach($data as $key => $value)
		{
			$values [] =" `{$key}` = '{$value}'" ;
		}
		$and = [];
		if(!is_array($condition))
		{
			// $sql = "UPDATE `{$this->tableName}` SET ".implode(',', $values).", `updated_at` = current_timestamp() WHERE `{$this->primaryKey}`='{$condition}' ";
			$and[] = " `{$this->primaryKey}` = '{$condition}' " ;
		}
		if(is_array($condition))
		{
			foreach ($condition as $key => $value)
			{
				$and [] =" `{$key}` = '{$value}'" ;
			}

		}
	  	$sql ="UPDATE `{$this->tableName}` SET ".implode(',', $values).", `updated_at` = current_timestamp() WHERE ".implode('AND', $and) ;
		$result = $this->getAdapter()->update($sql);
		if(!$result)
		{
			$sql ="UPDATE `{$this->tableName}` SET ".implode(',', $values)." WHERE ".implode('AND', $and) ;
			$result = $this->getAdapter()->update($sql);
		}
		return $result;
	}

	public function delete($condition)
	{
		if(is_array($condition))
		{
			foreach ($condition as $key => $value) {
			$and [] =" `{$key}` = '{$value}'" ;
			}

			$sql = "DELETE FROM `{$this->tableName}` WHERE ".implode('AND', $and) ;
		}
		else
		{
			$sql = "DELETE FROM `{$this->tableName}` WHERE `{$this->tableName}`.`{$this->primaryKey}` = '{$condition}'  ";
		}
		$result = $this->getAdapter()->delete($sql);
		return $result;
	}

    public function removeData($key)
    {
    	if (array_key_exists($key, $this->data))
    	{
    		unset($this->data[$key]);
    	}

    }

    public function insertMultiple($rows, $condition)
    {
    	foreach ($rows as $row)
		{
			$uniqueColumn = [$condition => $row[$condition]];
			$result = $this->insertUpdateOnDuplicate($row, $uniqueColumn);
			var_dump($result);
		   	if(!$result)
		   	{
				return false;		   	 	
		   	}
		}
		return true;
    	
    }

    public function insertMultipleOnConditionUpdate($rows, $condition)
    {
    	foreach ($rows as $row)
		{
			$conditionVal = $row[$condition];
			$sql = "SELECT * FROM `{$this->tableName}` WHERE `{$condition}` = '{$conditionVal}'";
			$result = $this->fetchRow($sql);

			if($result)
			{
				$update = $this->update($row, $result[$this->getPrimaryKey()]);
			   	if(!$update)
			   	{
					return false;		   	 	
			   	}
			}
			else
			{
				$insert = $this->insert($row);
				if(!$insert)
				{
					return false;		   	 	
				}
				return true;
			}
		}
    	
    }
}
 
?>