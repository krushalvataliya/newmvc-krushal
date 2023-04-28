<?php 

class Block_Salesman_Edit extends  Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/edit.phtml');	
	}

	public function getRow()
	{
		$salesman = Ccc::getModel('Salesman');
		if($this->getId())
		{
			$salesman = $salesman->load($this->getId());
		}
		
		return $salesman;
	}    

}