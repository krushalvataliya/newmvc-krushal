<?php 

class Model_Category_Resource extends Model_Core_Table_Resource
{

	
	 function __construct()
	{
		$this->setTableName('category');
		$this->setPrimaryKey('category_id');
	}

	
	
}

?>