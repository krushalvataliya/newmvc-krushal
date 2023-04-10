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

		echo $sql = "INSERT INTO `{$this->tableName}` (`{$key}`) VALUES ('{$value}')";
		$result = $this->getAdapter()->insert($sql);
		return $result;

	}

	public function update($data,$condition)
	{
			foreach($data as $key => $value)
			{
				$values [] =" `{$key}` = '{$value}'" ;
			}
		if(!is_array($condition))
		{
		echo $sql = "UPDATE `{$this->tableName}` SET ".implode(',', $values).", `updated_at` = current_timestamp() WHERE `{$this->primaryKey}`='{$condition}' ";
		}
		$and = [];
		if(is_array($condition))
		{
			foreach ($condition as $key => $value) {
			$and [] =" `{$key}` = '{$value}'" ;
			}
		echo $sql ="UPDATE `{$this->tableName}` SET ".implode(',', $values).", `updated_at` = current_timestamp() WHERE ".implode('AND', $and) ;

		}
		$result = $this->getAdapter()->update($sql);
		return $result;
	}

	public function delete($condition)
	{
		if(is_array($condition))
		{
			foreach ($condition as $key => $value) {
			$and [] =" `{$key}` = '{$value}'" ;
			}

		echo $sql = "DELETE FROM `{$this->tableName}` WHERE ".implode('AND', $and) ;
		}
		else
		{
		echo $sql = "DELETE FROM `{$this->tableName}` WHERE `{$this->tableName}`.`{$this->primaryKey}` = '{$condition}'  ";
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
}
 
?>