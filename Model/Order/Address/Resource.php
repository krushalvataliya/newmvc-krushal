<?php 
class Model_Order_Address_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('order_Address');
		$this->setPrimaryKey('address_id');
	}
	
}
