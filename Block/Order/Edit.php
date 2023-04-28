<?php 

class Block_Order_Edit extends  Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('payment_method/edit.phtml');	
	}

	public function getRow()
	{
		$order = Ccc::getModel('Order');
		if($this->getId())
		{
			$order = $order->load($this->getId());
		}
		
		return $order;
	}    

}