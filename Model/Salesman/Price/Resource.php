<?php 
class Model_Salesman_Price_Resource extends Model_Core_Table_Resource
{

	
	 function __construct()
	{
		$this->setTableName('salesman_price');
		$this->setPrimaryKey('entity_id');
	}

	

}

?>

