<?php 

class Block_Brand_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('brand/edit.phtml');	
	}

	public function getAddData()
	{
		$brand = Ccc::getModel('brand');
		$this->setData(['brand' => $product]);	
	}
	public function getRow()
	{
		if(Ccc::getRegistry('item'))
		{
		return (Ccc::getRegistry('item'));
		}
		return Ccc::getModel('item');
	}
}