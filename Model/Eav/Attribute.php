<?php


class Model_Eav_Attribute extends Model_Core_Table
{
	function __construct()
	{
		parent::__construct();
		$this->setCollectionClass('Model_Eav_Attribute_Collection');
		$this->setResourceClass('Model_Eav_Attribute_Resource');
	}
	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Eav_Attribute_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Eav_Attribute_Resource::STATUS_DEFAULT];
	}

	public function getInputType()
	{
		if($this->input_type)
		{
			return $this->input_type; 
		}
		return Model_Eav_Attribute_Resource::ATTRIBUTE_OPTION_DEFAULT;
	}

	public function getBackendType()
	{
		if($this->backend_type)
		{
			return $this->backend_type; 
		}
		return Model_Eav_Attribute_Resource::BACKEND_TYPE_DEFAULT;
	}

	public function getInputTypeText()
	{
		$options = $this->getResource()->getInputTypeOptions();
		if (array_key_exists($this->input_type, $options))
		{
			return $options[$this->input_type];
		}
			return $options[ Model_Eav_Attribute_Resource::ATTRIBUTE_OPTION_DEFAULT];
	}

	public function getBackendTypeText()
	{
		$options = $this->getResource()->getBackendTypeOptions();
		if (array_key_exists($this->backend_type, $options))
		{
			return $options[$this->backend_type];
		}
			return $options[ Model_Eav_Attribute_Resource::ATTRIBUTE_OPTION_DEFAULT];
	}

	 public function getOptions()
    {
        $modelEavAttributeOption = Ccc::getModel('Eav_Attribute_Option');
        $sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` ={$this->attribute_id} ";
        $options = $modelEavAttributeOption->fetchAll($sql);
        return $options->getData();
    }
}
?>