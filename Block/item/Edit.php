<?php 

class Block_Item_Edit extends  Block_Core_Template
{
	
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
		$request = $this->getRequest();
		$id = $request->getParam('item_id');

		$sql = "SELECT * FROM `item` WHERE `item_id` = '{$id}'";
		$modelItem = Ccc::getModel('item');
		$row = $modelItem->fetchRow($sql);

		$sql2 = "SELECT `attribute_id` ,`value` FROM `item_text` WHERE `entity_id` = '{$id}'";
		$attributeValue1 =$modelItem->getResource()->getAdapter()->fetchPairs($sql2);

		$sql2 = "SELECT `attribute_id` ,`value` FROM `item_varchar` WHERE `entity_id` = '{$id}'";
		$attributeValue2 =$modelItem->getResource()->getAdapter()->fetchPairs($sql2);

		$sql2 = "SELECT `attribute_id` ,`value` FROM `item_int` WHERE `entity_id` = '{$id}'";
		$attributeValue3 =$modelItem->getResource()->getAdapter()->fetchPairs($sql2);

		$attributeValue = $attributeValue1+$attributeValue2+$attributeValue3;
		
		foreach ($attributeValue as $attributeId => $value)
		{
			$row->$attributeId=$value;
		}
		return $row;
	}
}