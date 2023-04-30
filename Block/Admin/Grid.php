<?php 
class Block_Admin_Grid extends  Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Admin');
	}

	protected function _prepareColumns()
	{	
		$this->addColumn('admin_id',[
			'title' =>'ADMIN_ID'
		]);	
		$this->addColumn('name',[
			'title' =>'NAME'
		]);
		$this->addColumn('email',[
			'title' =>'EMAIL'
		]);	
		$this->addColumn('status',[
			'title' =>'STATUS'
		]);	
		$this->addColumn('created_at',[
			'title' =>'CREATED_AT'
		]);	
		$this->addColumn('updated_at',[
			'title' =>'UPDATED_AT'
		]);
		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{	
		$this->addAction('edit',[
			'title' =>'edit',
			'method'=> 'getEditUrl'
		]);	
		$this->addAction('delete',[
			'title' =>'delete',
			'method'=> 'getDeleteUrl'
		]);	
		return parent::_prepareActions();
	}

	protected  function _prepareButtons()
	{
		$this->addButton('admin_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null,null,true)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['admin_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['admin_id'=>$row->getid()],true);
	}

	public function getColumnValue($row, $key)
	{
		if ($key == 'status')
		{
			return $row->getStatusText();
		}
		
		return $row->$key;
	}

	public function getCollection()
	{
		$modelAdmin = Ccc::getModel('admin');
		$sql = "SELECT COUNT(admin_id) FROM `admins`;";
		$count =$modelAdmin->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `admins` ORDER BY `admin_id` DESC LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()}";
		$admins =$modelAdmin->fetchAll($sql);
		return $admins;
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