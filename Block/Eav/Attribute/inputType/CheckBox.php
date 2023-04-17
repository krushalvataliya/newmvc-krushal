<?php 

class Block_Eav_Attribute_inputType_CheckBox extends Block_Core_Template
{
	protected $_attribute = null;
	protected $_row = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('eav/attribute/inputtype/checkbox.phtml');
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
    

    public function getRow()
    {
        return $this->_row;
    }

    public function setRow($_row)
    {
        $this->_row = $_row;

        return $this;
    }
}