<?php 

class Block_Product_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/edit.phtml');	
	}

	public function getAddData()
	{
		$product = Ccc::getModel('Product');
		$this->setData(['product' => $product]);	
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 1";
		$attributes = $modelAttribute->fetchAll($sql);
		if($attributes)
		{
		return $attributes->getData()	;
		}
		return null;
	}

	public function getRow()
	{
		return ($this->getData('item'));
	}
}