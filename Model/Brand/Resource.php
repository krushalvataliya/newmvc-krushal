<?php 

class Model_Brand_Resource extends Model_Core_Table_Resource
{
	 function __construct()
	{
		$this->setTableName('brand');
		$this->setPrimaryKey('brand_id');
	}

}

?>