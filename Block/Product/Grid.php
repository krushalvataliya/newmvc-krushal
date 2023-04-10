<?php 
class Block_Product_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/grid.phtml');
	}

	public function getProducts()
	{
		$modelProduct = Ccc::getModel('Product');
		$sql = "SELECT * FROM `products`";
		$products =$modelProduct->fetchAll($sql);
		return $products;
	}

}