<?php 

class Block_Admin_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('admin/edit.phtml');
	}

	public function getAddData()
	{
		$modelRowAdmin = Ccc::getModel('admin');
		$this->setData($modelRowAdmin);
		return $this;
	}
}