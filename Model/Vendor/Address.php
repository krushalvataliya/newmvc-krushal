<?php 

class Model_Vendor_Address extends Model_Core_Table
{
    function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Vendor_Address_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Vendor_Address_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Vendor_Address_Resource::STATUS_DEFAULT];
	}
}
