<?php 

class Block_Admin_Edit extends  Block_Core_Template
{
	protected $_id = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('admin/edit.phtml');
	}

	public function getRow()
	{
		$admin = Ccc::getModel('admin');
		if($this->getId())
		{
			$admin =$admin->load($this->getId());
		}
		
		return $admin;
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