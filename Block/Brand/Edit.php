<?php 

class Block_Brand_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('brand/edit.phtml');	
	}

	public function getRow()
	{
		$brand = Ccc::getModel('Brand');
		if($this->getId())
		{
			$brand =$brand->load($this->getId());
		}

		return $brand;
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

    public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = ".Model_Brand::ENTITY_TYPE_ID;
		$attributes = $modelAttribute->fetchAll($sql);
		if($attributes)
		{
			return $attributes->getData();
		}
		return null;
	}
}