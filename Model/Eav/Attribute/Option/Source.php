<?php 

/**
 * 
 */
class Model_Eav_Attribute_Option_Source extends Model_Eav_Attribute_Option
{
	protected $_attribute =  null;
	
	function __construct()
	{
		parent::__construct();
	}

	public function getOptions()
	{
		$sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = '{$this->getAttribute()->getid()}' ORDER BY `position` ASC";
		$options = $this->fetchAll($sql);
		return $options->getData();
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