<?php 
class Model_Product_Media_Resource extends Model_Core_Table_Resource
{

	
	 function __construct()
	{
		$this->setTableName('media');
		$this->setPrimaryKey('media_id');
	}

	
}

?>