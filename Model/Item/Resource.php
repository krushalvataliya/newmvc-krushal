<?php
/**
 * 
 */
class Model_Item_Resource extends Model_Core_Table_Resource
{
	 function __construct()
	{
		$this->setTableName('item');
		$this->setPrimaryKey('item_id');
	}

	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL,
		];
	}

}
