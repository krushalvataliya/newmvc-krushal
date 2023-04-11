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
}