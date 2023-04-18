<?php 

class Model_core_Adapter{
	public $serverName="localhost";
	public $userName="root";
	public $password="";
	public $databaseName ="newmvc-krushal";
  	public $connect = null;

	public function connect(){
      if($this->connect == null)
      {
		$this->connect = mysqli_connect($this->serverName, $this->userName, $this->password, $this->databaseName);
      }
      return $this->connect;
	  }  

   public function fetchAll($query){
   	$result =$this->connect()->query($query);
   	if($result->num_rows == 0){
   		return null;
   	}
   		return $result->fetch_all(MYSQLI_ASSOC);
   }

    public function fetchPairs($query){
      $result =$this->connect()->query($query);
      if($result->num_rows == 0){
         return null;
      }
      $result = $result->fetch_all();
      $collumn1 = array_column($result, '0');
      $collumn2 = array_column($result, '1');
      if(!$collumn2)
      {
         $collumn2 = array_fill(0, count($collumn1), null);
      }
      return array_combine($collumn1, $collumn2);
   }

   public function fetchOne($query){
      $result =$this->connect()->query($query);
      if($result->num_rows == 0){
         return null;
      }
      $row = $result->fetch_array();
      return (array_key_exists(0, $row)) ? ($row[0]):(null);
   }

   public function fetchRow($query){
   	$result =$this->connect()->query($query);
   	if($result->num_rows == 0){
   		return null;
   	}
   		return $result->fetch_assoc();
   }
   
   public function insert($query){
   	$connect =$this->connect();
      $result=$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return $connect->insert_id;
   }

   public function update($query){
   	$result =$this->connect()->query($query);
   	if(!$result){
   		return false;
   	}
   		return true;
   }

    function delete($query){
   	$result =$this->connect()->query($query);
   	if(!$result){
   		return false;
   	}
   		return true;
   }

   function query($query){
      $result =$this->connect()->query($query);
      if(!$result){
         return false;
      }
         return $result->fetch_assoc();
   }

}

?> 	