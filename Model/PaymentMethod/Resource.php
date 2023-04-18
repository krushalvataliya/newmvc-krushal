<?php 

class Model_PaymentMethod_Resource extends Model_Core_Table_Resource
{

	

	 function __construct()
	{
		$this->setTableName('payment_methods');
		$this->setPrimaryKey('payment_method_id');
	}

	

}

?>