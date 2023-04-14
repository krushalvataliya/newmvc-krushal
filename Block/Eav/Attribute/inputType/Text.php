<?php 

class Block_Eav_Attribute_inputType_Text extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('eav/attribute/inputtype/text.phtml');
	}
}