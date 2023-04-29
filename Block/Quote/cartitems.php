<?php

/**
 * 
 */
class Block_Quote_Cartitems extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('quote/cartitems.phtml');
	}

	public function getTotal()
	{
		$quote = new Block_Quote_Create();
		return $quote->getTotal();
	}


}