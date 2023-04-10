<?php 

class Block_Vendor_Address_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('vendor/address/edit.phtml');
	}

	public function prepareData()
	{
			
	}
}