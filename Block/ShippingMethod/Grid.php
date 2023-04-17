<?php 
class Block_ShippingMethod_Grid extends  Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Shipping Method');
	}

	protected function _prepareColumns()
	{	
		$this->addColumn('shiping_method_id',[
			'title' =>'SHIPING_METHOD_ID'
		]);	
		$this->addColumn('name',[
			'title' =>'NAME'
		]);
		$this->addColumn('amount',[
			'title' =>'AMOUNT'
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
		$this->addButton('shiping_method_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['shiping_method_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['shiping_method_id'=>$row->getid()],true);
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
		$modelShippingMethod = Ccc::getModel('ShippingMethod');
		$sql = "SELECT * FROM `shiping_methods`";
		$shippingMethods =$modelShippingMethod->fetchAll($sql);
		return $shippingMethods;
	}

}