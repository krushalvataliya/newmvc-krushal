<?php 
class Block_PaymentMethod_Grid extends  Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage payment_method');
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();

	}

	protected function _prepareColumns()
	{
		
		$this->addColumn('payment_method_id',
			['title' =>'Abc']
		);	
		$this->addColumn('name',
			['title' =>'PAYMENT_METHOD_ID']
		);	
		$this->addColumn('status',
			['title' =>'STATUS']
		);	
		$this->addColumn('created_at',
			['title' =>'CREATED_AT']
		);	
		$this->addColumn('updated_at',
			['title' =>'UPDATED_AT']
		);
	}

	protected function _prepareActions()
	{
		
		$this->addColumn('edit',
			['title' =>'edit',
			'method'=> 'getEditUrl'
		]);	
		$this->addColumn('delete',
			['title' =>'delete',
			'method'=> 'getDeleteUrl'
		]);	
	
	}

	protected  function _prepareButtons()
	{
		$this->addButton('payment_method_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['id'=>$row->getid()],true);
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
		$modelPaymentMethod =Ccc::getModel('PaymentMethod');
		$sql = "SELECT * FROM `payment_methods`";
		$paymentMethods =$modelPaymentMethod->fetchAll($sql);
		return $paymentMethods->getData();
	}

}