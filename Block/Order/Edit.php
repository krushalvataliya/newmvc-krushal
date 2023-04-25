<?php 

class Block_Order_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('payment_method/edit.phtml');	
	}

	public function getRow()
	{
		$order = Ccc::getModel('Order');
		if($this->getId())
		{
			$order = $order->load($this->getId());
		}
		
		return $order;
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