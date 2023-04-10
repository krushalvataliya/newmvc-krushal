<?php 
/**
 * 
 */
class Model_Entity_type_Resource extends Model_Core_Table_Resource
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTableName('entity_type');
		$this->setPrimaryKey('entity_type_id');
	}
}