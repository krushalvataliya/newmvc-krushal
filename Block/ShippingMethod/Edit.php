<?php 

class Block_ShippingMethod_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('shipping_method/edit.phtml');	
	}

	public function getAddData()
	{
		$modelShippingMethod = Ccc::getModel('ShippingMethod');
		$this->setData(['shippingMethod'=>$modelShippingMethod]);
	}
}