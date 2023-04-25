<?php 

class Block_Vendor_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('vendor/edit.phtml');	
	}

	public function getAddData()
	{
		$vendor = Ccc::getModel('Vendor');
		$vendorAddress = Ccc::getModel('Vendor_Address');
		$this->setData(['vendor'=>$vendor,'vendorAddress'=>$vendorAddress]);
	}

	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = ".Model_Vendor::ENTITY_TYPE_ID;
		$attributes = $modelAttribute->fetchAll($sql);
		if($attributes)
		{
		return $attributes->getData()	;
		}
		return null;
	}

	public function getRow()
	{
		$vendor = Ccc::getModel('Vendor');
		if($this->getId())
		{
			$vendor = $vendor->load($this->getId());
		}
		
		return $vendor;
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