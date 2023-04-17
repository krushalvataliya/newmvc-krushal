<?php
/**
 * 
 */
class Model_Core_Table
{

	protected $data = [];
    protected $resource = null;
    protected $resourceClass = 'Model_Core_Table_Resource';
    protected $collection = null;
    protected $collectionClass = 'Model_Core_Table_Collection';


    public function __construct()
    {
        
    }
	public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;
    }

    public function __unset($key)
    {
    	if (array_key_exists($key, $this->data)) {
        unset($this->data[$key]);
    	}
    	return $this;
    }
  
    public function getData($key = null)
    {
        if(!$key)
        {
        return $this->data;
        }
        if(array_key_exists($key, $this->data))
        {
            return $this->data[$key];
        }
        return null;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    	
    }

    public function removeData($key)
    {
    	if(array_key_exists($key, $this->data))
    	{
    		unset($this->data[$key]);
    	}
    	return $this;
    }

    public function load($id, $column = null)
    {
        if (!$column) 
        {
            $column = $this->getResource()->getPrimaryKey();
        }

        $query = "SELECT * FROM `{$this->getResource()->getResourceName()}` 
                WHERE `{$column}` = '{$id}'";
        $table = new Model_Core_Table_Resource();

        $result = $table->fetchRow($query);
        if ($result) 
        {
            $this->data = $result;
        }

        return $this;
    }

    public function fetchAll($sql)
    {
        $result = $this->getResource()->fetchAll($sql);
        if(!$result)
        {
            return false;
        }
        foreach ($result as &$row)
        {
            $row = (new $this)->setData($row)->setResource($this->getResource())
                ->setCollection($this->getCollection());
        }
       $collection = $this->getCollection()->setData($result);
        return $collection;
    }

    public function fetchRow($sql)
    {
         $result = $this->getResource()->fetchRow($sql);
        if($result)
        {
            $this->setData($result);
        }
        return $this;
        
    }
    public function save()
    {
        if (array_key_exists($this->getResource()->getPrimaryKey(),$this->data))
        {
            $result = $this->getResource()->update($this->data ,$this->getData($this->getResource()->getPrimaryKey()));
            return $result;
        }
        $insertId = $this->getResource()->insert($this->data);
        return $this->load($insertId);
    }

    public function delete()
    {
        if (array_key_exists($this->getResource()->getPrimaryKey(),$this->data))
        {
            $result = $this->getResource()->delete($this->getData($this->getResource()->getPrimaryKey()));
            return $result;
        }
    }

    public function getResource()
    {
        if ($this->resource) {
            return $this->resource;
        }
        $resourceClass = $this->resourceClass;
        $resource = new $resourceClass();
        $this->setResource($resource);
        return $resource;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    public function getResourceClass()
    {
        return $this->resourceClass;
    }

    public function setResourceClass($resourceClass)
    {
        $this->resourceClass = $resourceClass;

        return $this;
    }

    public function getId()
    {
        $primaryKey = $this->getResource()->getPrimaryKey();
        return (int)$this->$primaryKey;
    }

    public function setId($id)
    {
        $this->data[$this->getResource()->getPrimaryKey()] = (int)$id;

        return $this;
    }

    public function getCollection()
    {
        if ( $this->collection) {
            return  $this->collection;
        }
        $collectionClass = $this->collectionClass;
        $resource = new $collectionClass();
        $this->setCollection($resource);
        return $resource;
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    public function getCollectionClass()
    {
        return $this->collectionClass;
    }

    public function setCollectionClass($collectionClass)
    {
        $this->collectionClass = $collectionClass;

        return $this;
    }
}
?>