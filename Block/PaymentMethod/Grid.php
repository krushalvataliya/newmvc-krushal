<?php 
class Block_PaymentMethod_Grid extends  Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage payment Method');
	}

	protected function _prepareColumns()
	{	
		$this->addColumn('payment_method_id',[
			'title' =>'PAYMENT METHOD ID'
		]);	
		$this->addColumn('name',[
			'title' =>'NAME'
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
		$this->addButton('payment_method_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null,null,true)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['payment_method_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['payment_method_id'=>$row->getid()],true);
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
		$sql = "SELECT COUNT(payment_method_id) FROM `payment_methods`;";
		$count =$modelPaymentMethod->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `payment_methods` ORDER BY `payment_method_id` DESC LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()}";
		$paymentMethods =$modelPaymentMethod->fetchAll($sql);
		return $paymentMethods;
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