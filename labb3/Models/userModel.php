<?php
namespace Model;
require_once('/Common/validation.php');
require_once ('dataBaseHandler.php');
require_once ('user.php');
require_once ('/Common/errormessages.php');

class UserModel{
private $db;
private $validator;
private $errorList = array();
	function __construct(\Model\DatabaseHandler $db){
		
		$this->db = $db;
		$this->validator = new \Common\Validator();
	}
	function CreateUser($username, $password, $img){
				
		if($this->validator->ValidateUsername($username) && $this->validator->ValidatePassword($password) ){
			$this->db->ConnectToDb();
			$sqlquery = "INSERT INTO users (Username, Password, ImagePath) VALUES(?,?,?)";
			$stmt = $this->db->Prepare($sqlquery);
		 	$stmt->bind_param("sss", $username, $password, $img);
			$this->db->RunInsertQuery($stmt);	
		return true;
		}
		else{
			$errorList = \Common\Validator::GetValidationErrors();
			return false;
		}   		
	}
	function GetErrorList(){
		
		return $this->errorList;
	}
	function RemoveUser( $id){
		
	
		$mysqli = $this->db->ConnectToDb();
		$stmt = $this->db->Prepare("DELETE FROM Users WHERE Id = ?");
	 	$stmt->bind_param("i", $id);
		$this->db->RunDeleteQuery($stmt);
	}
	/**
	 * @return array
	 */
	function GetAllUsers(){

		$errormessage = "";
		$sql =  "SELECT Id, Username, Password FROM Users";
		
		if ($stmt = $this->db->Prepare($sql)) {
	 	
		    $userList = $this->db->SelectMany($stmt);
		
			return $userList;
		}
	    
	}
	/**
	 * @return User
	 */
	function FindUser($username){
				
		if($this->validator->ValidateUsername($username)){
			
			$sql = "SELECT Id, Username, Password, imagepath FROM Users WHERE Username=?" ;
			$stmt = $this->db->Prepare($sql);
		 	$stmt->bind_param("s", $username);
			$userlist = $this->db->SelectMany($stmt);
			if($userlist != null)		{
	        $user = new User($userlist[0]['Id'],$userlist[0]['Username'], $userlist[0]['Password'],$userlist[0]['imagepath']  );
	    
		 	return $user;	
			}
			else {
				return false;
			}
		}
	}
	
}
		
	

