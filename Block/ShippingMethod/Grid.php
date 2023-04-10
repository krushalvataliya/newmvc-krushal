<?php 
class Block_ShippingMethod_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('shipping_method/grid.phtml');
	}

	public function getShippingMethods()
	{
		$modelShippingMethod = Ccc::getModel('ShippingMethod');
		$sql = "SELECT * FROM `shiping_methods`";
		$shippingMethods =$modelShippingMethod->fetchAll($sql);
		return $shippingMethods;
	}

}