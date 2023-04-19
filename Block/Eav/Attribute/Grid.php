<?php 
/**
 * 
 */
class Block_Eav_Attribute_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Eav Attribute');
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
	}

	protected function _prepareColumns()
	{	
		$this->addColumn('attribute_id',[
			'title' =>'ATTRIBUTE ID'
		]);	
		$this->addColumn('entity_type_id',[
			'title' =>'ENTITY TYPE'
		]);
		$this->addColumn('code',[
			'title' =>'CODE'
		]);
		$this->addColumn('backend_type',[
			'title' =>'BACKEND_TYPE'
		]);
		$this->addColumn('name',[
			'title' =>'NAME'
		]);
		$this->addColumn('status',[
			'title' =>'STATUS'
		]);	
		$this->addColumn('source_model',[
			'title' =>'SOURCE MODEL'
		]);
		$this->addColumn('input_type',[
			'title' =>'INPUT_TYPE'
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
		$this->addButton('attribute_id', [
			'title' => 'Add New',
			'url' => $this->getUrl('add', null)
		]);
		return parent::_prepareButtons();
	}

	public function getEditUrl($row, $key)
	{
		return $this->geturl($key, null,['attribute_id'=>$row->getid()],true);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->geturl($key, null,['attribute_id'=>$row->getid()],true);
	}

	public function getColumnValue($row, $key)
	{
		if ($key == 'status') {
			return $row->getStatusText();
		}
		if ($key == 'backend_type') {
			return $row->getBackendTypeText();
		}
		if ($key == 'input_type') {
			return $row->getInputTypeText();
		}
		if ($key == 'entity_type_id') {
			return $row->getEntityName();
		}

		return $row->$key;
	}

	public function getCollection()
	{
		$attributes = Ccc::getModel('Eav_Attribute');
		$sql = "SELECT * FROM `eav_attribute`";
		$collection = $attributes->fetchAll($sql);
		return $collection;
	}

	

}