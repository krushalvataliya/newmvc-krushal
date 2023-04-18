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
		$this->addColumn('item_id',
		['title' =>'ENTITY_ID']
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
		$sql = "SELECT * FROM `item`";
		$items =$modelitem->fetchAll($sql);
		return $items;
	}

}