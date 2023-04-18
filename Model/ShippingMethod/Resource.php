<?php 

class Model_ShippingMethod_Resource extends Model_Core_Table_Resource
{

	
	 function __construct()
	{
		$this->setTableName('shiping_methods');
		$this->setPrimaryKey('shiping_method_id');
	}
	
	

}

?>