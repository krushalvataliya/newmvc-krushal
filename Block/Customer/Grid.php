<?php 
class Block_Customer_Grid extends  Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage customer');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('customer_id',
		['title' =>'CUSTOMER ID']
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
		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		// $this->addAction('grid',
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
	}

	protected  function _prepareButtons()
	{
		$this->addButton('customer_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null,null,true)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['customer_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['customer_id'=>$row->getid()],true);
	}

	public function getAddressUrl($row, $key)
	{
		return $this->geturl($key, 'customer_address',['customer_id'=>$row->getid()],true);
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
		$modelCustomer =Ccc::getModel('Customer');
		$sql = "SELECT COUNT(customer_id) FROM `customers`;";
		$count =$modelCustomer->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `customers` LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()}";
		$customers =$modelCustomer->fetchall($sql);	
		return $customers;
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


