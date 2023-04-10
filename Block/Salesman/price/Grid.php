<?php 
class Block_Salesman_Price_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/price/grid.phtml');
	}

	public function getSalesmen()
	{
		$modelSalesmanPrice =Ccc::getModel('Salesman_Price');
		$sql="SELECT * FROM `salesmen` ORDER BY `first_name` ASC";
		$salesmen = $modelSalesmanPrice->fetchAll($sql);
		return $salesmen;
	}

	public function getSalesmanPrice()
	{
		$request = $this->getRequest();
		$id=(int)$request->getParam('salesman_id');
		$modelSalesmanPrice =Ccc::getModel('Salesman_Price');
		$sql = "SELECT SP.entity_id, SP.salesman_price, P.sku, P.cost, P.price, P.product_id 
		FROM `products` P 
		LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = ".$id."";
		$prices = $modelSalesmanPrice->fetchAll($sql);
		return $prices;
	}

}