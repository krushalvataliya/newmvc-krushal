<?php 

class Model_Cart extends Model_Core_Table
{
	
	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Cart_Resource');
	}
}
?>