<?php 
class Model_Cart_Item_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('cart_item');
		$this->setPrimaryKey('cart_item_id');
	}
	
}
