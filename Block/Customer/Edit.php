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
}