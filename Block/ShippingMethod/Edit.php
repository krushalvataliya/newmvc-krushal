<?php 

class Block_ShippingMethod_Edit extends  Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('shipping_method/edit.phtml');	
	}

	public function getRow()
	{
		$shipingMethod = Ccc::getModel('ShippingMethod');
		if($this->getId())
		{
			$shipingMethod = $shipingMethod->load($this->getId());
		}
		
		return $shipingMethod;
	}    

}