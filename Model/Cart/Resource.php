<?php 

class model_Cart_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('cart');
		$this->setPrimaryKey('cart_id');
	}
	
}


?>