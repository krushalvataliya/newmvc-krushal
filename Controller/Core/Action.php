<?php
class Controller_Core_Action
{
	public $request = null;
	public $modelUrl = null;
	public $session = null;
	public $message = null;
	public $view = null;
	protected $layout = null;
	protected $_response = null;


	public function getRequest()
	{
		if($this->request)
		{
			return $this->request;
		}
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}

    protected function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function errorAction($action)
	{
		throw new Exception("method:{$action} does not exists.", 1);
		
	}

	public function redirect($a=null,$c=null, array $perameters=null,$reset = false,$url=null)
	{
		if($url == null){
			$url = $this->getModelUrl()->getUrl($a,$c,$perameters,$reset);
		}
		header("location: {$url}");
		exit();
	}

	public function render()
	{
		$this->getView()->render();
	}

    public function getModelUrl()
    {
        if($this->modelUrl)
		{
			return $this->modelUrl;
		}
		$url = new Model_Core_url();
		$this->setModelUrl($url);
		return $url;
    }

    protected function setModelUrl(Model_Core_Url $url)
    {
        $this->modelUrl = $url;

        return $this;
    }

    public function getSession()
    {
    	 if($this->session)
		{
			return $this->session;
		}
		$session = new Model_Core_Session();
		$this->setSession($session);
		return $this->session;
    }

    protected function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    public function getMessage()
    {
        if($this->modelUrl)
		{
			return $this->modelUrl;
		}
		$message = new Model_Core_Message();
		$this->setMessage($message);
		return $message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
    
      public function getView()
    {
    	if ($this->view)
    	{
        return $this->view;
    	}
    	$view = Ccc::getModel('Core_View');
    	$this->setView($view);
    	return $view;
    }

    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    public function getLayout()
    {
    	if ($this->layout)
    	{
        return $this->layout;
    	}
    	$layout = new Block_Core_Layout();
    	$this->setLayout($layout);
    	return $layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function setResponse($_response)
    {
        $this->_response = $_response;
        return $this;
    }

    public function getResponse()
    {
    	if ($this->_response)
    	{
        	return $this->_response;
    	}
    	$response = Ccc::getModel('Core_Response');
    	$response->setController($this);
    	$this->setResponse($response);
    	return $response;
    }
    public function renderLayout()
    {
    	$layout = $this->getLayout()->toHtml();
    	$this->getResponse()->setBody($layout);
    }
}
?>