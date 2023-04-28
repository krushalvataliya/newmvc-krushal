<?php 
class Block_Vendor_Grid extends  Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('MANAGE VENDOR');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('vendor_id',
		['title' =>'VENDOR ID']
		);	
		$this->addColumn('first_name',
		['title' =>'FIRST NAME']
		);	
		$this->addColumn('last_name',
		['title' =>'LAST NAME']
		);	
		$this->addColumn('email',
		['title' =>'EMAIL']
		);	
		$this->addColumn('gender',
		['title' =>'GENDER']
		);	
		$this->addColumn('mobile',
		['title' =>'MOBILE']
		);		
		$this->addColumn('status',
		['title' =>'STATUS']
		);
		$this->addColumn('company',
		['title' =>'COMPANY']
		);	
		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		// $this->addAction('view',
		// 	['title' =>'view address',
		// 	'method'=> 'getAddressUrl'
		// ]);
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
		$this->addButton('vendor_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null,null,true)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['vendor_id'=>$row->getid()],true);
	}
	
	public function getAddressUrl($row, $key)
	{
		return $this->geturl($key, null,['vendor_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['vendor_id'=>$row->getid()],true);
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
		$modelVendor =Ccc::getModel('Vendor');
		$sql = "SELECT COUNT(vendor_id) FROM `vendors`;";
		$count =$modelVendor->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `vendors` LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()}";
		$vendors =$modelVendor->fetchall($sql);	
		return $vendors;
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