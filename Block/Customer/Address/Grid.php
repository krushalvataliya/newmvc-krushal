<?php 
class Block_Customer_Address_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer/address/grid.phtml');
	}

	public function getCustomerAddress()
	{
		$request = $this->getRequest();
		$customerId=(int) $request->getParam('customer_id');
		$modelCustomerAddress =Ccc::getModel('Customer_Address');
		$sql = "SELECT * FROM `customer_address` WHERE `customer_id` = {$customerId}";
		$customerAddress =$modelCustomerAddress->fetchRow($sql);
		return $customerAddress;
	}

	public function getBillingAddress()
	{
		return Ccc::getModel('Customer')->getBillingAddress();
	}

	public function getShippingAddress()
	{
		return Ccc::getModel('Customer')->getShippingAddress();
	}


}