<?php 
/**
 * 
 */
class Block_Eav_Attribute_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('eav/attribute/grid.phtml');
	}

	public function getCollection()
	{
		$attributes = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute`";
		$collection = $attributes->fetchAll($sql);
		return $collection;
	}

	

}