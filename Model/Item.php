<?php 
/**
 * 
 */
class Model_Item extends Model_Core_Table
{
	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Item_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Product_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Product_Resource::STATUS_DEFAULT];
	}

	public function getAttributeValue($attribute)
	{
		$sql = "SELECT `value` FROM `item_{$attribute->backend_type}` WHERE `entity_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}' ";
		return $this->getResource()->getAdapter()->fetchOne($sql);
	}
}