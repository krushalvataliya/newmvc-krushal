<?php 
/**
 * 
 */
class Model_Core_Log
{
	const DIR_PATH = 'Var';
	protected $_handler = null;
	
	function __construct()
	{
	}
	public function open($filName)
	{
		$filePath = Ccc::getBaseDir(DS.self::DIR_PATH).ds.$filName;
		$this->_handler = fopen($filePath, 'a');
	}

	public function close()
	{
		$filePath = Ccc::getBaseDir(DS.self::DIR_PATH).ds.$filName;
		fclose($this->_handler);
	}
	public function write($data)
	{

		fwrite($this->_handler, date('y-m-d H-i-s')." : ".print_r($data, true)."\n\n");
	}

	public function log($data,$filName = 'system.log',$newFile = false)
	{
		$this->open($filName);
		$this->write($data);
		$this->closeFile();
	}
}
