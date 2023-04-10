<?php 
class Block_Admin_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('admin/grid.phtml');
	}

	public function getAdmins()
	{
		$modelProduct = Ccc::getModel('admin');
		$sql = "SELECT * FROM `admins`";
		$admins =$modelProduct->fetchAll($sql);
		return $admins;
	}

}