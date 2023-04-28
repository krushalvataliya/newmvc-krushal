<?php 

class Block_Core_Layout extends Block_Core_Template
{
	protected $_session = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('core/layout/3columns.phtml');
		$this->prepareChilderen();
	}
	public function prepareChilderen()
	{

		$header = $this->createBlock('Html_Header');
		$this->addChild('header',$header);

		$message = $this->createBlock('Html_Message');
		$this->addChild('message',$message);

		$left = $this->createBlock('Html_Left');
		$this->addChild('left',$left);

		$content = $this->createBlock('Html_Content');
		$this->addChild('content',$content);

		$right = $this->createBlock('Html_Right');
		$this->addChild('right',$right);

		
		$footer = $this->createBlock('Html_Footer');
		$this->addChild('footer',$footer);
	}

	public function createBlock($block)
	{
		$blockClass = 'Block_'.$block;
		$block =  new $blockClass();
		$block->setLayout($this);
		return $block;	
	}

	public function getSession()
    {
        if($this->_session)
        {
        	return $this->_session;
        }
        $session = Ccc::getModel('Core_Session');
        $this->setSession($session);
        return $session;
    }

    public function setSession($_session)
    {
        $this->_session = $_session;

        return $this;
    }
}