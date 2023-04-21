<?php 

class model_Order_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('order');
		$this->setPrimaryKey('order_id');
	}
	
}


?>