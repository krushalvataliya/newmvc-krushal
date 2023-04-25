<?php 

class Model_Core_Response
{
	protected $controller = null;
	protected $_jsonData = [
		'status' =>'success',
		'message' =>'success',
		'messageBlockHtml' => null
	];
	
	function __construct()
	{
		
	}

	public function setBody($content)
	{
		echo $content;
		header("Content-type:text/html");
	}

	public function jsonResponse($data)
	{
		$this->setJsonData($data);
		$this->setMessageResponse();
		$data = json_encode($this->getJsonData());
		header("Content-type:application/json");
		echo $data;
	}

    public function getJsonData()
    {
        return $this->_jsonData;
    }

    public function setJsonData($jsonData)
    {
        $this->_jsonData = array_merge($this->_jsonData, $jsonData);

        return $this;
    }

    public function setMessageResponse()
    {
    	$message = $this->getController()->getLayout()->createBlock('Html_message')->toHtml();
    	$this->setJsonData(['messageBlockHtml'=> $message]);
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }
}