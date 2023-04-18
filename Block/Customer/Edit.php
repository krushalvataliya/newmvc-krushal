<?php 

class Block_Customer_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer/edit.phtml');	
	}

	public function getAddData()
	{
		$customer = Ccc::getModel('Customer');
		$customerAddress = Ccc::getModel('Customer_Address');
		$this->setData(['customer'=>$customer,'customerAddress'=>$customerAddress]);		
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 4";
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