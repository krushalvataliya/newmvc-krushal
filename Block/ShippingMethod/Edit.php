<?php 

class Block_ShippingMethod_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('shipping_method/edit.phtml');	
	}

	public function getRow()
	{
		$shipingMethod = Ccc::getModel('ShippingMethod');
		if($this->getId())
		{
			$shipingMethod = $shipingMethod->load($this->getId());
		}
		
		return $shipingMethod;
	}

    public function getId()
    {
        return $this->_id;
    }

    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }
}