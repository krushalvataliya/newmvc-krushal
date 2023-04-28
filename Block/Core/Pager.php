<?php

class Block_Core_Pager extends Block_Core_Template
{
	protected $PagerModel = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('core/pager.phtml');
	}

    public function getPagerModel()
    {
        return $this->PagerModel;
    }

    public function setPagerModel($PagerModel)
    {
        $this->PagerModel = $PagerModel;

        return $this;
    }
}