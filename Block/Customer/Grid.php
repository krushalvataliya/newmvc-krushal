<?php 
class Block_Customer_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer/grid.phtml');
	}

	public function getCustomers()
	{
		$modelCustomer =Ccc::getModel('Customer');
		$sql = "SELECT * FROM `customers`";
		$customers =$modelCustomer->fetchall($sql);	
		return $customers;
	}

}