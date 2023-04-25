<?php 

class Block_Salesman_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/edit.phtml');	
	}

	public function getRow()
	{
		$salesman = Ccc::getModel('Salesman');
		if($this->getId())
		{
			$salesman = $salesman->load($this->getId());
		}
		
		return $salesman;
	}

    public function getId()
    {
        return $this->_id;
    }

    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }
}