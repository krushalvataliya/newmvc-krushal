<?php 

class Block_Product_Media_Grid extends  Block_Core_Template
{	
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/media/grid.phtml');
	}

	public function getMedia()
	{
		$request = $this->getRequest();
		$productId=(int)$request->getParam('product_id');
		$sql ="SELECT * FROM `media` WHERE `product_id`= '{$this-> getId()}' ;";
		$modelProductMedia =Ccc::getModel('Product_Media');
		$media =$modelProductMedia->fetchAll($sql);
		return $media;
	}

    public function getId()
    {
    	$session = Ccc::getModel('Core_Session');
    	$this->setId($session->get('product_id'));
        return $this->_id;
    }

    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }
}