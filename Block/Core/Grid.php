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
    	if($key ,$this->_columns)
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
    	if($key ,$this->_actions)
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
    	if($key ,$this->_buttons)
    	{
    		return $this->_buttons[$key];
    	}
    	return null;
    }
    protected function _prepareColumns()
    {
    	
    }

    protected function _prepareActions()
    {
    	
    }
    protected function _prepareButtons()
    {
    	
    }

}