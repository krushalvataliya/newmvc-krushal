<?php 

class Block_Eav_Attribute_inputType extends Block_Core_Template
{
	protected $_attribute = null;
    protected $_row = null;

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

    public function getInptTypeName()
    {
        if($this->getAttribute()->input_type == 'textbox')
        {
            $this->getLayout()->createBlock('Eav_Attribute_inputType_Text')->setAttribute($this->getAttribute())->render();
        }

        if($this->getAttribute()->input_type == 'textarea')
        {
            $this->getLayout()->createBlock('Eav_Attribute_inputType_TextArea')->setAttribute($this->getAttribute())->render();
        }

        if($this->getAttribute()->input_type == 'select')
        {
            $this->getLayout()->createBlock('Eav_Attribute_inputType_Select')->setAttribute($this->getAttribute())->render();
        }

        if($this->getAttribute()->input_type == 'multiselect')
        {
            $this->getLayout()->createBlock('Eav_Attribute_inputType_MultiSelect')->setAttribute($this->getAttribute())->render();
        }

        if($this->getAttribute()->input_type == 'radio')
        {
            $this->getLayout()->createBlock('Eav_Attribute_inputType_Radio')->setAttribute($this->getAttribute())->render();
        }

        if($this->getAttribute()->input_type == 'checkbox')
        {
            $this->getLayout()->createBlock('Eav_Attribute_inputType_CheckBox')->setAttribute($this->getAttribute())->render();
        }
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