<?php 
/**
 * 
 */
class Model_Core_File_Export
{
	protected $fileName = 'table.csv';

	public function putData($data)
	{
		$file = fopen($this->getFileName(),"w+");
	    $header = null;
		foreach ($data as $row)
		{
			if(!$header)
			{
				$header =  array_keys($row);
			    fputcsv($file,$header);
			}
		    fputcsv($file,$row);
		}
		fclose($file);
		return $this;
	}

	public function export()
	{
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=".$this->getFileName());
		header("Content-Type: application/csv; "); 
		
		readfile($this->getFileName());
		unlink($this->getFileName());
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