<?php 
class Block_Category_Grid extends  Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('category/grid.phtml');
	}

	public function getCategories()
	{
		$modelRowCetegory = Ccc::getModel('Cetegory');
		$sql = "SELECT * FROM `category` WHERE category_id > 1 ORDER BY `path` ASC;";
		$categories = $modelRowCetegory->fetchAll($sql);	
		return $categories;
	}

}