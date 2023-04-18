<?php 
class Model_Vendor_Resource extends Model_Core_Table_Resource
{
	
	 function __construct()
	{
		$this->setTableName('vendors');
		$this->setPrimaryKey('vendor_id');
	}
	
}

?>