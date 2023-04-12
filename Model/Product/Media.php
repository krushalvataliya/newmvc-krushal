<?php 

class Model_Product_Media extends Model_Core_Table
{
	
	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Product_Media_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Product_Media_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Product_Media_Resource::STATUS_DEFAULT];
	}

	public function getRequest()
	{
		return Ccc::getModel('Core_Request');
	}

	public function getThumbnail()
	{
		$id = $this->getRequest()->getParam('product_id');
		$modelProduct =Ccc::getModel('Product');
		$sql = "SELECT `thumbnail_id` FROM `products` WHERE `product_id` = {$id} ";
		$thumbnailId = $modelProduct->fetchRow($sql);
		return $thumbnailId->thumbnail_id;
	}

	public function getMidium()
	{
		$id = $this->getRequest()->getParam('product_id');
		$modelProduct =Ccc::getModel('Product');
		$sql = "SELECT `midium_id` FROM `products` WHERE `product_id` = {$id} ";
		$midiumId = $modelProduct->fetchRow($sql);
		return $midiumId->midium_id;
	}
	public function getSmall()
	{
		$id = $this->getRequest()->getParam('product_id');
		$modelProduct =Ccc::getModel('Product');
		$sql = "SELECT `small_id` FROM `products` WHERE `product_id` = {$id} ";
		$smallId = $modelProduct->fetchRow($sql);
		return $smallId->small_id;
	}

	public function getLarge()
	{
		$id = $this->getRequest()->getParam('product_id');
		$modelProduct =Ccc::getModel('Product');
		$sql = "SELECT `large_id` FROM `products` WHERE `product_id` = {$id} ";
		$largeId = $modelProduct->fetchRow($sql);
		return $largeId->large_id;
	}

}
?>