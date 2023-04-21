<?php 
class Model_Quote_Address_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('Quote_Address');
		$this->setPrimaryKey('address_id');
	}
	
}
