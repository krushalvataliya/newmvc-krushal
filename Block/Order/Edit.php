<?php 

class Block_Order_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('payment_method/edit.phtml');	
	}


}