<?php

/**
 * 
 */
class Model_Core_File_Csv
{
	protected $file = null;
	protected $filePath = 'var';
	protected $fileName = null;
    protected $handler = null;
    protected $header = [];
    protected $rows = [];
	function __construct()
	{
			
	}

    public function setPath($subPath)
    {
    	if($subPath)
    	{
        	$this->filePath = Ccc::getBaseDir(DS.$this->filePath.DS.$subPath);
    	}

        return $this;
    }

    public function read($path)
    {
        $this->open();
        while (($row = fgetcsv($this->getHandler() !== FALSE)
        {
            if(!$this->header)
            {
                $this->header = $row;
            }
            else
            {
                $this->rows[] = array_combine($this->header, $row);
            }
        }
        $this->close();
        return $this;
    }
    
    public function open()
    {
        $file = $this->getPath().DS.$this->getFileName();
        $this->handler =  fopen($file, "r");
        return $this;
        
    }

    public function close()
    {
        if($this->getHandler())
        {
            fclose($this->getHandler());
        }
        
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

    public function getHandler()
    {
        return $this->handler;
    }

    public function setHandler($handler)
    {
        $this->handler = $handler;

        return $this;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function setRows($rows)
    {
        $this->rows = $rows;

        return $this;
    }
}