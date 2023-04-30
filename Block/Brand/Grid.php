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
			'url' => $this->getUrl('add', null,null,true)
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
		if($key == 'image')
		{
			return "<img style=\"height: 100px;width: 100px;\" class=\"img-thumbnail imgsize\" src=\"View/brand/image/$row->image\">";
		}
		return $row->$key;
	}

	public function getCollection()
	{
		$modelbrand = Ccc::getModel('Brand');
		$sql = "SELECT COUNT(brand_id) FROM `brand`;";
		$count =$modelbrand->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `brand` ORDER BY `name` ASC LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()} ;";

		$products =$modelbrand->fetchAll($sql);
		return $products;
	}
	public function getPagerModel()
    {
        if($this->PagerModel)
        {
        	return $this->PagerModel;
        }
        $page = (!$this->getRequest()->getParam('p'))? 1 : $this->getRequest()->getParam('p');
        $PagerModel = new Model_Core_Pager($this->getCountRows(),$page);
        $PagerModel->setRecordPerPage($this->getRecordPerPage());
        $PagerModel->calculate();
        $this->setPagerModel($PagerModel);
        return $PagerModel;
    }
    
    



}