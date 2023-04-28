<?php

class Model_Core_Pager
{
	protected $_totalRecords = null;
	protected $_currentPage = null;
	protected $_recordPerPage = 10;
	protected $_noOfPage = null;
	protected $_start = 1;
	protected $_previous = null;
	protected $_next = null;
	protected $_end = null;
	protected $_startLimit = null;
    protected $_recordOption = [
                '10'=>'10',
                '20'=>'20',
                '50'=>'50',
                '100'=>'100',
                '200'=>'200'
            ];

	function __construct($totalRecords,$currentPage)
	{
		$this->setTotalRecords($totalRecords);
		$this->setCurrentPage($currentPage);
	}
	public function calculate()
	{
		$this->setNoOfPage(ceil($this->getTotalRecords()/$this->getRecordPerPage()));

		$this->setStartLimit(($this->getCurrentPage()-1)* $this->getRecordPerPage());
		$this->setEnd($this->getNoOfPage());

		if($this->_currentPage == 0)
		{
			return false;
		}
		$this->setPrevious( $this->getCurrentPage() - 1);

		$this->setNext($this->getCurrentPage() + 1);

        if($this->getNoOfPage() == 0)
        {
            $this->setCurrentPage(0);
            $this->setNext(0);
            $this->setPrevious(0);
        }
        if($this->getCurrentPage() <= 1)
        {
            $this->setPrevious(0);
            $this->setStartLimit(0);
            $this->setCurrentPage(1);
        }
        if($this->getCurrentPage() <= 1)
        {
            $this->setPrevious(0);
            $this->setStartLimit(0);
            $this->setCurrentPage(1);
        }
        if($this->getCurrentPage()== $this->getnoOfPage())
        {
            $this->setNext(0);
        }
	}

    public function getTotalRecords()
    {
        return $this->_totalRecords;
    }

    public function setTotalRecords($_totalRecords)
    {
        $this->_totalRecords = $_totalRecords;

        return $this;
    }

    public function getCurrentPage()
    {
        if($this->_currentPage > $this->getNoOfPage())
        {
            return $this->getNoOfPage();
        }

        return $this->_currentPage;
    }

    public function setCurrentPage($_currentPage)
    {
        $this->_currentPage = $_currentPage;

        return $this;
    }

    public function getRecordPerPage()
    {
        return $this->_recordPerPage;
    }

    public function setRecordPerPage($_recordPerPage)
    {
        $this->_recordPerPage = $_recordPerPage;

        return $this;
    }

    public function getNoOfPage()
    {
        return $this->_noOfPage;
    }

    public function setNoOfPage($noOfPage)
    {
        $this->_noOfPage = $noOfPage;

        return $this;
    }

    public function getStart()
    {
        return $this->_start;
    }

    public function setStart($_start)
    {
        $this->_start = $_start;

        return $this;
    }

    public function getPrevious()
    {
        return $this->_previous;
    }

    public function setPrevious($_previous)
    {
        $this->_previous = $_previous;

        return $this;
    }

    public function getNext()
    {
        return $this->_next;
    }

    public function setNext($_next)
    {
        $this->_next = $_next;

        return $this;
    }

    public function getEnd()
    {
        return $this->_end;
    }

    public function setEnd($_end)
    {
        $this->_end = $_end;

        return $this;
    }

    public function getStartLimit()
    {
        return $this->_startLimit;
    }

    public function setStartLimit($_startLimit)
    {
        $this->_startLimit = $_startLimit;

        return $this;
    }

    public function getRecordOption()
    {
        return $this->_recordOption;
    }
}