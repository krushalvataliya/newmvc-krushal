<?php 
class Block_Category_Grid extends  Block_Core_Grid
{

	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage categories');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('category_id',[
			'title' =>'CATEGORY_ID'
		]);
		$this->addColumn('name',[
			'title' =>'NAME'
		]);
		$this->addColumn('path',[
			'title' =>'PATH'
		]);
		$this->addColumn('status',[
			'title' =>'STATUS'
		]);
		$this->addColumn('description',[
			'title' =>'DESCRIPTION'
		]);
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
		$this->addButton('category_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null,null,true)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['category_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['category_id'=>$row->getid()],true);
	}

	public function getColumnValue($row, $key)
	{
		if ($key == 'status') {
			return $row->getStatusText();
		}
		if ($key == 'path') {
			return $row->getPathName();
		}
		return $row->$key;
	}

	public function getCollection()
	{
		$modelRowCategory = Ccc::getModel('Category');
		$sql = "SELECT COUNT(category_id) FROM `category`;";
		$count =$modelRowCategory->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `category` WHERE category_id > 1 ORDER BY `path` ASC LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()}";
		$categories = $modelRowCategory->fetchAll($sql);	
		return $categories;
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