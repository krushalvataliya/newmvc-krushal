<?php 
class Block_Salesman_Address_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/address/grid.phtml');
	}

	public function getSalesmanAddress()
	{
		$request = $this->getRequest();
		$salesmanId=(int) $request->getParam('salesman_id');
		$modelSalesmanAddress =Ccc::getModel('salesman_Address');
		$sql = "SELECT * FROM `salesman_address` WHERE `salesman_id` = {$salesmanId}";
		$salesmanAddress =$modelSalesmanAddress->fetchRow($sql);
		return $salesmanAddress;
	}

}