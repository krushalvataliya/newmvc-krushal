<?php

/**
 * 
 */
class Block_Quote_Customer extends Block_Core_Template
{
	protected $_session = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('quote/customer.phtml');
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