<?php 
class Block_item_Grid extends  Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage item');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('item_id',
		['title' =>'ITEM_ID']
		);	
		$this->addColumn('name',
		['title' =>'NAME']
		);
		$this->addColumn('type',
		['title' =>'TYPE']
		);

		$this->addColumn('sku',
		['title' =>'SKU']
		);
		$this->addColumn('entity_type_id',
		['title' =>'entity_type_id']
		);	
		$this->addColumn('status',
		['title' =>'STATUS']
		);	
		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		$this->addAction('edit',
			['title' =>'edit',
			'method'=> 'getEditUrl'
		]);	
		$this->addAction('delete',
			['title' =>'delete',
			'method'=> 'getDeleteUrl'
		]);
		return parent::_prepareActions();
	}

	protected  function _prepareButtons()
	{
		$this->addButton('item_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['item_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['item_id'=>$row->getid()],true);
	}

	public function getMediaUrl($row, $key)
	{
		return $this->geturl($key, 'item_media',['item_id'=>$row->getid()],true);
	}

	public function getColumnValue($row, $key)
	{
		if ($key == 'status') {
			return $row->getStatusText();
		}
		return $row->$key;
	}

	public function getCollection()
	{
		$modelitem = Ccc::getModel('item');
		$sql = "SELECT I.*, IVName.`value` as name , IVType.`value` as type FROM `item` I
		LEFT JOIN `item_varchar` IVName ON I.`item_id` = IVName.`entity_id` AND IVName.`attribute_id`= 38
		LEFT JOIN `item_varchar` IVType ON I.`item_id` = IVType.`entity_id` AND IVType.`attribute_id`= 40";

		$items =$modelitem->fetchAll($sql);
		return $items;
	}

}