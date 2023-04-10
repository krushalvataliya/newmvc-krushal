<?php 

class Block_Salesman_Address_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/address/edit.phtml');	
	}

	public function prepareData()
	{
			
	}
}