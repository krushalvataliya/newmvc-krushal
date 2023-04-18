<?php 
class Block_Category_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('category/edit.phtml');
	}

	public function getAddData()
	{
		$category = Ccc::getModel('Cetegory');
		$sql = "SELECT * FROM `category` ORDER BY `path` ASC;";
		$categories = Ccc::getModel('Cetegory')->fetchAll($sql);
		$this->setData(['category'=>$category,'categoriesData'=>$categories]);
		return $this;
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 4";
		$attributes = $modelAttribute->fetchAll($sql);
		if($attributes)
		{
			return $attributes->getData();
		}
		return null;
	}

	public function getRow()
	{
		return ($this->getData('item'));
	}
}