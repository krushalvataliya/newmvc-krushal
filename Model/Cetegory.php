<?php 

class Model_Cetegory  extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT  = 1;
	const ENTITY_TYPE_ID = 4;
	
	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}
    function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Cetegory_Resource');
		$this->setCollectionClass('Model_Cetegory_Collection');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Cetegory::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Cetegory::STATUS_DEFAULT];
	}

	public function updatePath()
	{
		if(!$this->getId())
		{
			return false;
		}
		$parent = Ccc::getModel('Cetegory')->load($this->parent_id);
		$oldPath = $this->path;
		if(!$parent)
		{
			$this->path = $this->getId(); 
		}
		else
		{
			$this->path =$parent->path.'='.$this->getId(); 
		}
		$this->save();
		$sql = "UPDATE `category`
		SET `path` = REPLACE(`path`,'{$oldPath}=','{$this->path}=')
		WHERE `path` LIKE '{$oldPath}=%';";
		$this->getResource()->getAdapter()->update($sql);
		return $this;
	}

	public function getPathName()
	{
		$pathArry = explode('=', $this->path);
		$sql = "SELECT `category_id`,`name` FROM `category`;";
		$categoryNameArray = $this->getResource()->getAdapter()->fetchPairs($sql);
		foreach ($pathArry as $id2 => &$cetegoryId)
		{
			foreach ($categoryNameArray as $key => $cetegoryName)
			{
				if($cetegoryId == $key)
				{
					$cetegoryId = $cetegoryName ;
				}
			}
		}
		return implode('=>', $pathArry);
	}

	public function getAttributeValue($attribute)
	{
		$sql = "SELECT `value` FROM `category_{$attribute->backend_type}` WHERE `entity_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}' ";
		return $this->getResource()->getAdapter()->fetchOne($sql);
	}
}

?>