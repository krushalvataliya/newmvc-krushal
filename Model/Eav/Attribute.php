<?php


class Model_Eav_Attribute extends Model_Core_Table
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
		return Model_Eav_Attribute::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Eav_Attribute::STATUS_DEFAULT];
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

	public function getEntityName()
	{
		$sql = "SELECT `name` FROM `entity_type` WHERE `entity_type_id` = '{$this->entity_type_id}' ";
		return $this->getResource()->getAdapter()->fetchOne($sql);
	}

	 public function getOptions()
    {
    	$sourceModel = $this->source_model;
    	if(!$sourceModel)
    	{
    		$sourceModel = "Eav_Attribute_Option_Source";
    	}
        $modelEavAttributeOption = Ccc::getModel($sourceModel);
        $sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` ='{$this->attribute_id}' ORDER BY `position` ASC";
        return Ccc::getModel($sourceModel)->setAttribute($this)->getOptions();
    }
}
?>