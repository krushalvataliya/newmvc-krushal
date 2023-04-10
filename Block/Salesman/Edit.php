<?php 

class Block_Salesman_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/edit.phtml');	
	}

	public function getaddData()
	{
		$salesman = Ccc::getModel('salesman');
		$salesmanAddress = Ccc::getModel('salesman_Address');
		$this->setData(['salesman'=>$salesman,'salesmanAddress'=>$salesmanAddress]);		
	}
}