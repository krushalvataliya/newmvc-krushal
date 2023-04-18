<?php 
class Model_Vendor_Address_Resource extends Model_Core_Table_Resource
{

	
	 function __construct()
	{
		$this->setTableName('vendor_address');
		$this->setPrimaryKey('address_id');
	}
	

}

?>