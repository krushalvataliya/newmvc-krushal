<?php 
class Block_Salesman_Grid extends  Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Salesman');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('salesman_id',
		['title' =>'SALESMAN ID']
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
		$this->addAction('edit',
			['title' =>'edit',
			'method'=> 'getEditUrl'
		]);	
		$this->addAction('delete',
			['title' =>'delete',
			'method'=> 'getDeleteUrl'
		]);
		$this->addAction('grida',
			['title' =>'view address',
			'method'=> 'getAddressUrl'
		]);
		$this->addAction('grid',
			['title' =>'prices',
			'method'=> 'getPriceUrl'
		]);
		return parent::_prepareActions();
	}

	protected  function _prepareButtons()
	{
		$this->addButton('salesman_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['salesman_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['salesman_id'=>$row->getid()],true);
	}

	public function getPriceUrl($row, $key)
	{
		return $this->geturl($key, 'salesman_price',['salesman_id'=>$row->getid()],true);
	}

	public function getAddressUrl($row, $key)
	{
		return $this->geturl('grid', 'salesman_address',['salesman_id'=>$row->getid()],true);
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
		$modelProduct = Ccc::getModel('Salesman');
		$sql = "SELECT * FROM `salesmen`";
		$products =$modelProduct->fetchAll($sql);
		return $products;
	}

}