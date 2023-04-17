<?php 

class Model_Customer extends Model_Core_Table
{
    function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Customer_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status;
		}
		return Model_Customer_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Customer_Resource::STATUS_DEFAULT];
	}

	public function getAddresses()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('customer_id');
		$sql = "SELECT * FROM `customer_address` where `customer_id` = '{$id}';";
		$modelAddress = Ccc::getModel('Customer_Address');
		$addresses = $modelAddress->fetchAll($sql);
		return $addresses;
	}

	public function getBillingAddress()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('customer_id');
		$address = Ccc::getModel('Customer_Address');
		if($id)
		{
		$sql = "SELECT * FROM `customers` WHERE `customer_id` = '{$id}' ";
		$customer = $this->fetchRow($sql);

		$sql = "SELECT * FROM `customer_address` WHERE `address_id` = '{$customer->billing_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}

	public function getShippingAddress()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('customer_id');
		$address = Ccc::getModel('Customer_Address');
		if($id)
		{
		$sql = "SELECT * FROM `customers` WHERE `customer_id` = '{$id}' ";
		$customer = $this->fetchRow($sql);

		$sql = "SELECT * FROM `customer_address` WHERE `address_id` = '{$customer->shiping_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}

}