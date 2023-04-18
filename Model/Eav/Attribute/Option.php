<?php


class Model_Eav_Attribute_Option extends Model_Core_Table
{
	protected $_attribute = null;
	
	function __construct()
	{
		parent::__construct();
		$this->setCollectionClass('Model_Eav_Attribute_Option_Collection');
		$this->setResourceClass('Model_Eav_Attribute_Option_Resource');
	}

    public function getAttribute()
    {
        return $this->_attribute;
    }

    public function setAttribute($_attribute)
    {
        $this->_attribute = $_attribute;

        return $this;
    }
}
?>