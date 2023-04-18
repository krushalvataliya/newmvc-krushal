<?php 
class Block_Brand_Grid extends  Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage brand');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('brand_id',
		['title' =>'brand_id']
		);	
		$this->addColumn('name',
		['title' =>'NAME']
		);	
		$this->addColumn('description',
		['title' =>'DESCRIPTION']
		);	
		$this->addColumn('image',
		['title' =>'IMAGE']
		);	
		$this->addColumn('created_at',
		['title' =>'CREATED AT']
		);	
		$this->addColumn('updated_at',
			['title' =>'UPDATED AT']
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
		$this->addButton('brand_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['brand_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['brand_id'=>$row->getid()],true);
	}

	public function getMediaUrl($row, $key)
	{
		return $this->geturl($key, 'product_media',['brand_id'=>$row->getid()],true);
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
		$modelProduct = Ccc::getModel('Brand');
		$sql = "SELECT * FROM `brand` ORDER BY `name` ASC";
		$products =$modelProduct->fetchAll($sql);
		return $products;
	}

}