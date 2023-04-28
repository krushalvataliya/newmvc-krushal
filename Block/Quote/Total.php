<?php

class Block_Quote_Total extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('quote/total.phtml');
	}

	public function getTotal()
	{
		$quote = new Block_Quote_Grid();
		return $quote->getTotal();
	}

	public function getGrandTotal()
	{
		$quote = new Block_Quote_Grid();
		return $quote->getGrandTotal();
	}
}