<?php
/**
 * 
 */
class Model_Core_View
{
	protected $templete = null;
	protected $data = [];

    public function __construct()
    {
       
    }
    
	public function render()
	{
		require_once "View".DS.$this->getTemplete();
	}	

    public function getTemplete()
    {
        return $this->templete;
    }

    public function setTemplete($templete)
    {
        $this->templete = $templete;

        return $this;
    }

    public function getData($key = null)
    {
        if(!$key)
        {
        return $this->data;
        }
        if(array_key_exists($key, $this->data))
        {
            return $this->data[$key];
        }
        return null;
    }

    public function setData($value)
    {
        $this->data = $value;

        return $this;
    	
    }

    public function getModelUrl()
    {
        return Ccc::getModel('Core_url');
    }

    public function getRequest()
    {
        return Ccc::getModel('Core_Request');
    }

}

 ?>