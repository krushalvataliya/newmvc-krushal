<?php 

class Block_Html_Right extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('html/right.phtml');
	}
}