<?php 
class Block_PaymentMethod_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('payment_method/grid.phtml');
	}

	public function getPaymentMethods()
	{
		$modelPaymentMethod =Ccc::getModel('PaymentMethod');
		$sql = "SELECT * FROM `payment_methods`";
		$paymentMethods =$modelPaymentMethod->fetchAll($sql);
		return $paymentMethods;
	}

}