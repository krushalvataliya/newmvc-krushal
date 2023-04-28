<?php 
class Block_Order_Grid extends  Block_Core_Grid
{	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Order');
	}

	protected function _prepareColumns()
	{	
		$this->addColumn('quote_id',[
			'title' =>'QUOTE_ID'
		]);
		$this->addColumn('customer_id',[
			'title' =>'CUSTOMER_ID'
		]);
		$this->addColumn('total',[
			'title' =>'TOTAL'
		]);
		$this->addColumn('status',[
			'title' =>'STATUS'
		]);
		$this->addColumn('payment_method_id',[
			'title' =>'PAYMENT_METHOD_ID'
		]);
		$this->addColumn('shipping_method_id',[
			'title' =>'SHIPPING_METHOD_ID'
		]);
		$this->addColumn('shipping_amount',[
			'title' =>'SHIPPING_AMOUNT'
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
		$this->addButton('order', [
			'title' => 'Add New order',
			'url' => $this->getUrl('quote')
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['order'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['order'=>$row->getid()],true);
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
		$modelOrder =Ccc::getModel('order');
		$sql = "SELECT COUNT(order_id) FROM `order`;";
		$count =$modelOrder->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `order` LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()}";
		$orders =$modelOrder->fetchAll($sql);
		return $orders;
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
    
    

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;

        return $this;
    }
}