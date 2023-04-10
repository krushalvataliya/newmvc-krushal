<?php 

class Model_Cetegory  extends Model_Core_Table
{
    function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Cetegory_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Cetegory_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Cetegory_Resource::STATUS_DEFAULT];
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
}

?>