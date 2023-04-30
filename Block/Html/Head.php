<?php 

class Block_Html_Head extends Block_Core_Template
{
	protected $_title = null;
	protected $javascripts = [];
	protected $stysheets = [];
    const TITLE_DEFAULT = 'mvc';

	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('html/head.phtml');
        $this->_prepareCss();
        $this->_prepareJs();
	}
	
    public function getTitle()
    {
        if($this->_title)
        {
        return $this->_title;
        }
        return self::TITLE_DEFAULT;
    }

    public function setTitle($_title)
    {
        $this->_title = $_title;

        return $this;
    }

    public function getAllJs()
    {
        return $this->javascripts;
    }

    
    public function addJs($javascripts)
    {
        $this->javascripts[] = $javascripts;

        return $this;
    }

    public function getStysheets()
    {
        return $this->stysheets;
    }

    public function setStysheet($stysheets)
    {
        $this->stysheets[] = $stysheets;

        return $this;
    }

    protected function _prepareJs()
    {
        $this->addJs('Model/Skin/js/ajax.js');
        $this->addJs('Model/Skin/js/jquery-3.6.4.min.js');
    }

    protected function _prepareCss()
    {
        
        $this->setStysheet('Model/Skin/css/bootstrap.min.css');
        $this->setStysheet('Model/Skin/css/style.css');
    }
}