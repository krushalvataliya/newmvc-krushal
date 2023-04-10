<?php
/**
 * 
 */
class Model_Core_Table_Collection
{
	protected $data = [];

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }

    public function count()
    {
    	return count($this->data);
    }

    public function getFirstRow()
    {
    	if($this->data[0])
    	{
    		return $this->data[0];
    	}
    	
    	return null;
    }

    public function getLastRow()
    {
    	if($this->data[count($this->data)-1])
    	{
    		return $this->data[count($this->data)-1];
    	}
    	
    	return null;
    }

}