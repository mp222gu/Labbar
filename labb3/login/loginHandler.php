<?php
namespace Model;
require_once('/Models/databaseHandler.php');
require_once('/Common/validation.php');    
class LoginHandler{

	private $loggedinSessionString;
	private $usernameString = "username";
	private $passwordString = "password";
	
	private  $db;

	public function __construct(\Model\DatabaseHandler $db){
		
		$this->db = $db;
		$this->loggedinSessionString = "loggedin";
	}

	/**
	 * @return boolean
	 */
	function IsLoggedIn(){
		
		if(ISSET($_SESSION[$this->loggedinSessionString]) && ($_SESSION[$this->loggedinSessionString] == true)){
			return true;
		}
		return false;
	}
	
	
	/**
	 * @return boolean
	 * 
	*/
	function DoLogin($username, $password){
					
		$this->db->ConnectToDb();	
		$sqlquery = "SELECT id FROM users WHERE username = ? AND password = ?";
		$stmt = $this->db->Prepare($sqlquery);
		$stmt->bind_param("ss", $username, $password);
		$res = $this->db->SelectMany($stmt);
		if($res != null ) {
			
			$_SESSION[$this->loggedinSessionString] = true;
			$_SESSION[$this->usernameString] = $username;
			$_SESSION[$this->passwordString] = $password;
			
			return true;
		}
		return false;
	}
	/**
	 * @return User
	 */
	function GetLoggedinUser(){
		
	 	$this->db->ConnectToDb();
		$sqlquery = "SELECT Id, Username, Password, imagepath FROM Users WHERE Username=? AND Password = ?";
	 	$stmt = $this->db->Prepare($sqlquery);	
	 	$stmt->bind_param("ss", $_SESSION[$this->usernameString],$_SESSION[$this->passwordString]);
		$res = $this->db->SelectMany($stmt);
		$user = new \Model\User($res[0]['Id'], $res[0]['Username'], $res[0]['Password'],$res[0]['imagepath'] );
		
	 	return $user;
		
	}
	/**
	 * @return void
	 */
	function DoLogout(){
		
		$_SESSION[$this->loggedinSessionString] = false;
		$_SESSION[$this->usernameString] = "";
		$_SESSION[$this->passwordString] = "";
		
	}
}
