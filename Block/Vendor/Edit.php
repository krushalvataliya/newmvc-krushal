<?php 

class Block_Vendor_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('vendor/edit.phtml');	
	}

	public function getAddData()
	{
		$vendor = Ccc::getModel('Vendor');
		$vendorAddress = Ccc::getModel('Vendor_Address');
		$this->setData(['vendor'=>$vendor,'vendorAddress'=>$vendorAddress]);
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 3";
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