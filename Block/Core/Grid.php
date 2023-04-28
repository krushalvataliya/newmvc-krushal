<?php
/**
 * 
 */
class Block_Core_Grid extends Block_Core_Template
{
	protected $_title = null;
	protected $_columns = [];
	protected $_actions = [];
	protected $_buttons = [];
    protected $_currentPage = 1;
    protected $PagerModel = null;
    protected $countRows = null;
    protected $recordPerPage = 10;

	
	function __construct()
	{
		Parent::__construct();
		$this->setTemplete('core/grid.phtml');
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('manage grid');
	}

    public function getTitle()
    {
        return $this->_title;
    }

    public function setTitle($_title)
    {
        $this->_title = $_title;

        return $this;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    public function setColumns(array $_columns)
    {
        $this->_columns = $_columns;

        return $this;
    }

    public function addColumn($key, $value)
    {
    	$this->_columns[$key] = $value;
    	return $this;
    }

    public function removeColumn($key)
    {
    	unset($this->_columns[$key]);
    	return $this;
    }

    public function getColumn($key)
    {
    	if(array_key_exists($key ,$this->_columns))
    	{
    		return $this->_columns[$key];
    	}
    	return null;
    }

    public function getActions()
    {
        return $this->_actions;
    }

    public function setActions(array $_actions)
    {
        $this->_actions = $_actions;

        return $this;
    }

    public function addAction($key, $value)
    {
    	$this->_actions[$key] = $value;
    	return $this;
    }

    public function removeAction($key)
    {
    	unset($this->_actions[$key]);
    	return $this;
    }

    public function getAction($key)
    {
    	if(array_key_exists($key ,$this->_actions))
    	{
    		return $this->_actions[$key];
    	}
    	return null;
    }

    public function getButtons()
    {
        return $this->_buttons;
    }

    public function setButtons(array $_buttons)
    {
        $this->_buttons = $_buttons;

        return $this;
    }

     public function addButton($key, $value)
    {
    	$this->_buttons[$key] = $value;
    	return $this;
    }

    public function removeButton($key)
    {
    	unset($this->_buttons[$key]);
    	return $this;
    }

    public function getButton($key)
    {
    	if(array_key_exists($key ,$this->_buttons))	
    	{
    		return $this->_buttons[$key];
    	}
    	return null;
    }
    protected function _prepareColumns()
    {
        return $this;
    }

    protected function _prepareActions()
    {
        return $this;
    }
    protected function _prepareButtons()
    {
        return $this;
    }

    public function getCurrentPage()
    {
        return $this->_currentPage;
    }

    public function setCurrentPage($_currentPage)
    {
        $this->_currentPage = $_currentPage;

        return $this;
    }

    public function getPagerModel()
    {
        if($this->PagerModel)
        {
            return $this->PagerModel;
        }
        $page = (!$this->getRequest()->getParam('p'))? 1 : $this->getRequest()->getParam('p');
        $PagerModel = new Model_Core_Pager($this->getCountRows(),(int)$page);
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