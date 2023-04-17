<?php 

class Model_Salesman extends Model_Core_Table
{
    function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Salesman_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Salesman_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Salesman_Resource::STATUS_DEFAULT];
	}

	public function getAddresses()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('salesman_id');
		$sql = "SELECT * FROM `salesman_address` where `salesman_id` = '{$id}';";
		$modelAddress = Ccc::getModel('Salesman_Address');
		$addresses = $modelAddress->fetchAll($sql);
		return $addresses;
	}

	public function getBillingAddress()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('salesman_id');
		$address = Ccc::getModel('Salesman_Address');
		if($id)
		{
		$sql = "SELECT * FROM `salesman` WHERE `salesman_id` = '{$id}' ";
		$salesman = $this->fetchRow($sql);

		$sql = "SELECT * FROM `salesman_address` WHERE `address_id` = '{$salesman->billing_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}

	public function getShippingAddress()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('salesman_id');
		$address = Ccc::getModel('Salesman_Address');
		if($id)
		{
		$sql = "SELECT * FROM `salesman` WHERE `salesman_id` = '{$id}' ";
		$salesman = $this->fetchRow($sql);

		$sql = "SELECT * FROM `salesman_address` WHERE `address_id` = '{$salesman->shiping_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}
}

?>