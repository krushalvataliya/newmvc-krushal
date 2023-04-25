<?php 

class Block_PaymentMethod_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('payment_method/edit.phtml');	
	}

	public function getRow()
	{
		$paymentMethod = Ccc::getModel('PaymentMethod');
		if($this->getId())
		{
			$paymentMethod = $paymentMethod->load($this->getId());
		}
		
		return $paymentMethod;
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