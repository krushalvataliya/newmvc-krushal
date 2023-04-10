<?php 

class Block_Product_Media_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/media/grid.phtml');
	}

	public function getMedia()
	{
		$request = $this->getRequest();
		$productId=(int)$request->getParam('product_id');
		$sql ="SELECT * FROM `media` WHERE `product_id`= $productId ;";
		$modelProductMedia =Ccc::getModel('Product_Media');
		$media =$modelProductMedia->fetchAll($sql);
		return $media;
	}
}