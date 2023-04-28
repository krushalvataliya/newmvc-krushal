<?php 

class Block_PaymentMethod_Edit extends  Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('payment_method/edit.phtml');	
	}

	public function getRow()
	{
		$paymentMethod = Ccc::getModel('PaymentMethod');
		if($this->getId())
		{
			$paymentMethod = $paymentMethod->load($this->getId());
		}
		
		return $paymentMethod;
	}    

}