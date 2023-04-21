<?php 

class model_Quote_Resource extends Model_Core_Table_Resource
{

	 function __construct()
	{
		$this->setTableName('quote');
		$this->setPrimaryKey('quote_id');
	}
	
}


?>