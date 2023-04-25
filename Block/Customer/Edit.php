<?php 

class Block_Customer_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer/edit.phtml');	
	}

	public function getAddData()
	{
		$customer = Ccc::getModel('Customer');
		$customerAddress = Ccc::getModel('Customer_Address');
		$this->setData(['customer'=>$customer,'customerAddress'=>$customerAddress]);		
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` =".Model_Customer::ENTITY_TYPE_ID;
		$attributes = $modelAttribute->fetchAll($sql);
		if($attributes)
		{
		return $attributes->getData()	;
		}
		return null;
	}

	public function getRow()
	{
		$customer = Ccc::getModel('Customer');
		if($this->getId())
		{
			$customer =$customer->load($this->getId());
		}
		
		return $customer;
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