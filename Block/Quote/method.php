<?php

/**
 * 
 */
class Block_Quote_Method extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('quote/method.phtml');
	}


}