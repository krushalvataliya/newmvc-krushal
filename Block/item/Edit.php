<?php 

class Block_Item_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('item/edit.phtml');	
	}

	public function getAddData()
	{
		$item = Ccc::getModel('item');
		$this->setData(['item' => $item]);	
	}
	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 5";
		$attributes = $modelAttribute->fetchAll($sql);
		return $attributes->getData();
	}
}