<?php 

class Model_Vendor extends Model_Core_Table
{
    function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Vendor_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Vendor_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Vendor_Resource::STATUS_DEFAULT];
	}

	public function getAddresses()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('vendor_id');
		$sql = "SELECT * FROM `vendor_address` where `vendor_id` = '{$id}';";
		$modelAddress = Ccc::getModel('Vendor_Address');
		$addresses = $modelAddress->fetchAll($sql);
		return $addresses;
	}

	public function getBillingAddress()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('vendor_id');
		$address = Ccc::getModel('Vendor_Address');
		if($id)
		{
		$sql = "SELECT * FROM `vendors` WHERE `vendor_id` = '{$id}' ";
		$vendor = $this->fetchRow($sql);

		$sql = "SELECT * FROM `vendor_address` WHERE `address_id` = '{$vendor->billing_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}

	public function getShippingAddress()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('vendor_id');
		$address = Ccc::getModel('Vendor_Address');
		if($id)
		{
		$sql = "SELECT * FROM `vendors` WHERE `vendor_id` = '{$id}' ";
		$vendor = $this->fetchRow($sql);

		$sql = "SELECT * FROM `vendor_address` WHERE `address_id` = '{$vendor->shiping_address_id}';";
		$address = $address->fetchRow($sql);
		}
		return $address;
	}
}

?>