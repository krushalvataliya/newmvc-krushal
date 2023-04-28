<?php 

class Block_Admin_Edit extends  Block_Core_Template
{
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

}