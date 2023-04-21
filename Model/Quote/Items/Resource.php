<?php 
class Model_Quote_Items_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('quote_items');
		$this->setPrimaryKey('item_id');
	}
	
}
