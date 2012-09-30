<?php
require_once 'dataBaseHandler.php';
require_once 'user.php';
class UserModel{
private $db;
	function __construct(DatabaseHandler $db){
		
		$this->db = $db;
	}
	function CreateUser($username, $password, $img){
			
		$this->db->ConnectToDb();
		$sqlquery = "INSERT INTO users (Username, Password, ImagePath) VALUES(?,?,?)";
		$stmt = $this->db->Prepare($sqlquery);
	 	$stmt->bind_param("sss", $username, $password, $img);
		$this->db->RunInsertQuery($stmt);
		

	   
		
		
	}
	function RemoveUser($id){
			
		$mysqli = $this->db->ConnectToDb();
		$stmt = $this->db->Prepare("DELETE FROM Users WHERE Id = ?");
	 	$stmt->bind_param("i", $id);
		$this->db->RunDeleteQuery($stmt);
	}
	function GetAllUsers(){

		$errormessage = "";
		$mysqli = $this->db->ConnectToDb($errormessage);
		$sql =  "SELECT Id, Username, Password FROM Users";
		if ($stmt = $this->db->Prepare($sql)) {
	 	
		    $userList = $this->db->SelectMany($stmt);
		
			return $userList;
		}
	    /* fetch value */
	}
	
	function FindUser($username){
		$dbh = new DataBaseHandler();
		
		$errormessage = "";
		$mysqli = $dbh->ConnectToDb($errormessage);
		if ($stmt = $mysqli->prepare("SELECT Id, Username, Password, imagepath FROM Users WHERE Username=?")) {
	 	 $stmt->bind_param("s", $username);
		

	    /* execute query */
	    $stmt->execute();
	
	    /* bind result variables */
	    $stmt->bind_result($id, $username, $password, $imagepath);
		
		$stmt->fetch();
		
	
	    /* fetch value */
	   
	    if($username == null){
	    	return null;
	    }
	    else{
	    	$user = new User();
			$user->SetId($id);
			$user->SetUserName($username);
			$user->SetPassword($password);
			$user->SetImagePath($imagepath);
	    	return $user;
	    	
		}
	    	
	    	
		}
	}
	function Test(){
		
		
		$this->CreateUser("testuser", "password");
		if($this->FindUser("testuser") == null)
		{
			echo "fel på create user , användare skapades inte";
			
			return false;
		}
		$this->DeleteUser($this->FindUser("testuser")->GetId());
		if(!($this->FindUser("testuser") == null))
		{
			echo "fel på delete user , användare togs inte bort ";
			echo $this->FindUser("testuser");
			return false;
		}
		return true;
	}
	
	function AddImageToUser(){
			
		
	}
}
