<?php 

class Block_PaymentMethod_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('payment_method/edit.phtml');	
	}

	public function getaddData()
	{
		$paymentMethods = Ccc::getModel('PaymentMethod');
		$this->setData(['PaymentMethod'=>$paymentMethods]);	
	}
}