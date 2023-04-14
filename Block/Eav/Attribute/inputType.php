<?php 

class Block_Eav_Attribute_inputType extends Block_Core_Template
{
	protected $_attribute = null;

	function __construct()
	{
		parent::__construct();
		$this->setTemplete('eav/attribute/inputtype.phtml');
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