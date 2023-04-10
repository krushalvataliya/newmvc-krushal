<?php


class Model_Entity_type extends Model_Core_Table
{
	function __construct()
	{
		parent::__construct();
		$this->setCollectionClass('Model_Entity_type_Collection');
		$this->setResourceClass('Model_Entity_type_Resource');
	}
}
?>