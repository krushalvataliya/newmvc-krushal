<?php 

class Block_Item_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('item/edit.phtml');	
	}

	public function getAddData()
	{
		$item = Ccc::getModel('item');
		$this->setData(['item' => $item]);	
	}
	
	public function getAttributes()
	{
		$modelAttribute = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 5";
		$attributes = $modelAttribute->fetchAll($sql);
		return $attributes->getData()	;
	}

	public function getRow()
	{
		$item = Ccc::getModel('Item');
		if($this->getId())
		{
			$item = $item->load($this->getId());
		}
		
		return $item;
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