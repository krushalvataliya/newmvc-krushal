<?php 

class Block_Product_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/edit.phtml');	
	}

	public function getaddData()
	{
		$product = Ccc::getModel('Product');
		$this->setData(['product' => $product]);	
	}
}