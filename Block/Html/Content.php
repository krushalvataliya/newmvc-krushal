<?php 

class Block_Html_Content extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('html/Content.phtml');
	}
}