<?php 
class Block_Salesman_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/grid.phtml');
	}

	public function getSalesmen()
	{
		$modelSalesman =Ccc::getModel('Salesman');
		$sql = "SELECT * FROM `salesmen`";
		$salesmen =$modelSalesman->fetchall($sql);
		return $salesmen;
	}

}