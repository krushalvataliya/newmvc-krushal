<?php 
class Model_Order_Items_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('order_items');
		$this->setPrimaryKey('item_id');
	}
	
}
