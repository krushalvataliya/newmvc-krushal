<?php 

class Model_Salesman_Resource extends Model_Core_Table_Resource
{

	
	 function __construct()
	{
		$this->setTableName('salesmen');
		$this->setPrimaryKey('salesman_id');
	}

	

}

?>