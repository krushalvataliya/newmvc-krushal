<?php 
class Block_Category_Edit extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('category/edit.phtml');
	}

	public function getaddData()
	{
		$category = Ccc::getModel('Cetegory');
		$sql = "SELECT * FROM `category` ORDER BY `path` ASC;";
		$categories = Ccc::getModel('Cetegory')->fetchAll($sql);
		$this->setData(['category'=>$category,'categoriesData'=>$categories]);
		return $this;
	}
}