<?php 
class Block_Vendor_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('vendor/grid.phtml');
	}

	public function getVendors()
	{
		$modelVendor =Ccc::getModel('Vendor');
		$sql = "SELECT * FROM `vendors`";
		$vendors =$modelVendor->fetchall($sql);	
		return $vendors;
	}

}