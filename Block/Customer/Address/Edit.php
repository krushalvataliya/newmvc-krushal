<?php 

class Block_Customer_Address_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer/address/edit.phtml');	
	}

}