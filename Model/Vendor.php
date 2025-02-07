<?php 

class Model_Vendor extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT  = 1;
	const ENTITY_TYPE_ID = 3;
	
	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}
    function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Vendor_Resource');
		$this->setCollectionClass('Model_Vendor_Collection');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Vendor::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Vendor::STATUS_DEFAULT];
	}

	public function getAddress()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $this->vendor_id;
		$sql = "SELECT * FROM `vendor_address` where `vendor_id` = '{$id}';";
		$modelAddress = Ccc::getModel('Vendor_Address');
		$addresses = $modelAddress->fetchRow($sql);
		return $addresses;
	}

	public function getAttributeValue($attribute)
	{
		$sql = "SELECT `value` FROM `vendor_{$attribute->backend_type}` WHERE `entity_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}' ";
		return $this->getResource()->getAdapter()->fetchOne($sql);
	}
}

?>