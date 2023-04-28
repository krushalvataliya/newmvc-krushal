<?php

/**
 * 
 */
class Block_Quote_Products extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('quote/products.phtml');
	}
}