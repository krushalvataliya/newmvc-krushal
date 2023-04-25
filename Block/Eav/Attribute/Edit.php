<?php 

class Block_Eav_Attribute_Edit extends Block_Core_Template
{
	protected $_id = null;
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('eav/attribute/edit.phtml');
	}

	public function getRow()
	{
		$attribute = Ccc::getModel('Eav_Attribute');
		if($this->getId())
		{
			$attribute = $attribute->load($this->getId());
		}
		
		return $attribute;
	}

	public function getEntities()
	{
		$entityTypeModel = Ccc::getModel('entity_type');
		$sql = "SELECT * FROM `entity_type`";
		$collection = $entityTypeModel->fetchAll($sql);
		return $collection;
	}
	
	public function getOptions()
	{
		$request = $this->getRequest();
		$id = (int)$request->getParam('attribute_id');
		$options = Ccc::getModel('Eav_Attribute_Option');
		if($id)
		{
			$sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = '{$id}' ORDER BY `position` DESC";
			$options = $options->fetchAll($sql);
		}
		return $options;
	}

    public function getId()
    {
        return $this->_id;
    }

    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }

}