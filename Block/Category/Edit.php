<?php 
class Block_Category_Edit extends  Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('category/edit.phtml');
	}

	public function getRow()
	{
		$category = Ccc::getModel('Category');
		if($this->getId())
		{
			$category =$category->load($this->getId());
		}

		return $category;
	}

	public function getCategoriesData()
	{
		$category = Ccc::getModel('Category');
		$sql = "SELECT * FROM `category`";
		$categories =$category->fetchAll($sql);
		return $categories;
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` =".Model_Category::ENTITY_TYPE_ID;
		$attributes = $modelAttribute->fetchAll($sql);
		if($attributes)
		{
			return $attributes->getData();
		}
		return null;
	}    

}