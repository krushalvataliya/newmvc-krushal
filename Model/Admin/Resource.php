<?php 

class Model_Admin_Resource extends Model_Core_Table_Resource
{
	 function __construct()
	{
		$this->setTableName('admins');
		$this->setPrimaryKey('admin_id');
	}
	
	

}

?>