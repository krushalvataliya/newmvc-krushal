<?php
/**
 * 
 */
class Model_Eav_Attribute_Option_Resource extends Model_Core_Table_Resource
{
	protected $_attribute = null;
	
	function __construct()
	{
		parent::__construct();
		$this->setTableName('eav_attribute_option');
		$this->setPrimaryKey('option_id');
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