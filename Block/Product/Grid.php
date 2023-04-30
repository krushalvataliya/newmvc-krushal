<?php 
class Block_Product_Grid extends  Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage product');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('product_id',
		['title' =>'PRODUCT_ID']
		);	
		$this->addColumn('name',
		['title' =>'NAME']
		);	
		$this->addColumn('sku',
		['title' =>'SKU']
		);	
		$this->addColumn('cost',
		['title' =>'COST']
		);	
		$this->addColumn('price',
		['title' =>'PRICE']
		);	
		$this->addColumn('quantity',
		['title' =>'QUANTITY']
		);	
		$this->addColumn('description',
		['title' =>'DESCRIPTION']
		);	
		$this->addColumn('status',
		['title' =>'STATUS']
		);	
		
		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		$this->addAction('grid',
			['title' =>'images',
			'method'=> 'getMediaUrl'
		]);
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
		$this->addButton('product_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null,null,true)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['product_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['product_id'=>$row->getid()]);
	}

	public function getMediaUrl($row, $key)
	{
		return $this->geturl($key, 'product_media',['product_id'=>$row->getid()],true);
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
		$modelProduct = Ccc::getModel('Product');
		$sql = "SELECT COUNT(product_id) FROM `products`;";
		$count =$modelProduct->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT P.*,PVDesc.`value` as description FROM `products`P 
		LEFT JOIN `product_text` PVDesc ON P.`product_id` = PVDesc.`entity_id` AND PVDesc.`attribute_id`= 66 ORDER BY `product_id` DESC LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()} ";
		$products =$modelProduct->fetchAll($sql);
		return $products;
	}

}