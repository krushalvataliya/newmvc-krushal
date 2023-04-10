<?php 

class Block_Product_Media_Add extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/media/add.phtml');
	}
}