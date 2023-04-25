<?php 

class Block_Product_Index extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/index.phtml');
	}

	public function getAddData()
	{
		$product = Ccc::getModel('Product');
		$this->setData(['product' => $product]);	
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = ".Model_Product::ENTITY_TYPE_ID;
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