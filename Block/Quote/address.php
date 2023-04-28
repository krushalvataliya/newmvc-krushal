<?php

/**
 * 
 */
class Block_Quote_Address extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('quote/address.phtml');
	}
}