<?php
//php class to establish database connection
class Dbh{
	private $servername;
	private $username; 
	private $password; 
	private $dbname; 

	protected function connect(){
		$this->servername="localhost:3307";
		$this->username="root";
		$this->password="";
		$this->dbname="quora";
                //Creating 
		$conn=new mysqli($this->servername,$this->username,$this->password,$this->dbname);
		return $conn;
	}
}

//Php script for Inserting data to databse
class InsertData extends Dbh{
        function query($sql){
           $conn=$this->connect();
           mysqli_query($conn,$sql)or die(mysqli_error($conn));
        }
}  
//php script for checking if login credentials are true or not
class CheckFields extends Dbh{

        function check($sql){
        $result=$this->connect()->query($sql);
	$numRows=$result->num_rows;
        return $numRows;
	}
}
//php script for reteriving data from datbase
class Users extends Dbh{
	 function getTheData($sql){
		$result=$this->connect()->query($sql);
		$numRows=$result->num_rows;
		if($numRows>0){
			while($row=$result->fetch_assoc()){
				$data[]=$row;
		}
		return $data;
	    } 
	} 
}
//php script for getting all the data from the datbase
class viewUser extends Users{
	public  function showAllUsers(){
		// $data=$this->getTheData();
		// return $data;
		// //  foreach($data as $datas){
		//  	echo "firstName ".$datas['userName']."<br>";
		//  	echo "LastName ".$datas['password']."<br>";
		//  }
	}
}
class realEscape extends Dbh{
	public function realString($data){
	return	$this->connect()->real_escape_string($data);
	}

}
