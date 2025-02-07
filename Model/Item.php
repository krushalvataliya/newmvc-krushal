<?php 
/**
 * 
 */
class Model_Item extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT  = 1;
	
	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}
	const ENTITY_TYPE_ID = 5;
	
	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Item_Resource');
		$this->setCollectionClass('Model_Item_Collection');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Product::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Product::STATUS_DEFAULT];
	}

	public function getAttributeValue($attribute)
	{
		$sql = "SELECT `value` FROM `item_{$attribute->backend_type}` WHERE `entity_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}' ";
		return $this->getResource()->getAdapter()->fetchOne($sql);
	}
}