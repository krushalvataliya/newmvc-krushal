<?php

class Model_Eav_Attribute_Resource extends Model_Core_Table_Resource
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT  = 1;

	const ATTRIBUTE_OPTION_DEFAULT = "textbox";
	const BACKEND_TYPE_DEFAULT = "text";

	function __construct()
	{
		parent::__construct();
		$this->setTableName('eav_attribute');
		$this->setPrimaryKey('attribute_id');
	}

	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}

	public function getInputTypeOptions()
	{
		return [
			"textbox" => "Text Box",
			"textarea" => "Text Area",
			"select" => "Select",
			"multiselect" => "Multi Select",
			"radio" => "Radio",
			"checkbox" => "Check Box"
		];
	}

	public function getBackendTypeOptions()
	{
		return [
			"text" => "Text",
			"datetime" => "Date and Time",
			"decimal" => "Decimal",
			"int" => "Integer",
			"varchar" => "Varchar"
		];
	}
}
?>