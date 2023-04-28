<?php

/**
 * 
 */
class Model_Core_File_Upload
{
	protected $file = null;
	protected $filePath = 'Var';
	protected $extensions = ['csv'];
	protected $fileName = null;
	function __construct()
	{
			
	}

	public function upload($name)
	{
		if(!array_key_exists($name,$_FILES))
		{
			return false;
		}
		if(!$this->getFileName())
		{
			$this->setFileName($this->file['name']);
		}
		$this->file = $_FILES[$name];
		move_uploaded_file($this->file["tmp_name"], $this->getPath().DS.$this->getFileName());
	}


    public function setPath($subPath)
    {
    	if($subPath)
    	{
        	$this->filePath = Ccc::getBaseDir(DS.$this->filePath.DS.$subPath);
    	}

        return $this;
    }

    public function getExtensions()
    {
        return $this->extensions;
    }

    public function setExtensions(array $extensions)
    {
        $this->extensions = $extensions;

        return $this;
    }

    public function getPath()
    {
        return $this->filePath;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
}