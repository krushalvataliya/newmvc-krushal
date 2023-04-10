<?php 
class Block_Vendor_Address_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('vendor/address/grid.phtml');
	}

	public function getVendorAddress()
	{
		$request = $this->getRequest();
		$vendorId=(int) $request->getParam('vendor_id');
		$modelVendorAddress =Ccc::getModel('vendor_Address');
		$sql = "SELECT * FROM `vendor_address` WHERE `vendor_id` = {$vendorId}";
		$vendorAddress =$modelVendorAddress->fetchRow($sql);
		return $vendorAddress;
	}

}