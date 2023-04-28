<?php 

class Model_PaymentMethod extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT  = 1;
	
	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}
	public function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_PaymentMethod_Resource');
		$this->setCollectionClass('Model_PaymentMethod_Collection');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status;
		}
		return Model_PaymentMethod::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_PaymentMethod::STATUS_DEFAULT];
	}

	
}

?>