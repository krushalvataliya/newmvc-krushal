<?php 
/**
 * 
 */
class Block_Eav_Attribute_Grid extends Block_Core_Grid
{
	protected $PagerModel = null;
	protected $countRows = null;
	protected $recordPerPage = 10;
	
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
			'url' => $this->getUrl('add', null,null,true)
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
		$sql = "SELECT COUNT(attribute_id) FROM `eav_attribute`;";
		$count = $attributes->getResource()->getAdapter()->fetchOne($sql);
		$this->setCountRows($count);
		$sql = "SELECT * FROM `eav_attribute` ORDER BY `attribute_id` DESC LIMIT {$this->getPagerModel()->getStartLimit()},{$this->getPagerModel()->getRecordPerPage()}";
		$collection = $attributes->fetchAll($sql);
		return $collection;
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
    
    public function setPagerModel($PagerModel)
    {
        $this->PagerModel = $PagerModel;

        return $this;
    }

    public function getCountRows()
    {
        return $this->countRows;
    }

    public function setCountRows($countRows)
    {
        $this->countRows = $countRows;

        return $this;
    }

    public function getRecordPerPage()
    {
        if($this->recordPerPage)
        {
        	return $this->recordPerPage;
        }
       return 10;
    }

    public function setRecordPerPage($recordPerPage)
    {
        $this->recordPerPage = $recordPerPage;

        return $this;
    }



	

}