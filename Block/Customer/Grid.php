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
		$this->addButton('customer_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null)
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
		$sql = "SELECT * FROM `customers`";
		$customers =$modelCustomer->fetchall($sql);	
		return $customers;
	}

}


