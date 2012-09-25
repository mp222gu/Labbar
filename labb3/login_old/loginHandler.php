<?php

require_once 'settings.php';
require_once 'dataBaseHandler.php';
class LoginHandler{

	
	
	
	
	
    
	// Kollar ifall användare är inloggad	
	function IsLoggedIn(){
		
		
		if(ISSET($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == "true")){
			return true;
		}
		return false;
	}
	function GetLoggedinUser(){
		
		$dbh = new DataBaseHandler();
	
	 	$mysqli = $dbh->ConnectToDb();
		if ($stmt = $mysqli->prepare("SELECT Id, Username, Password, imagepath FROM Users WHERE Username=? AND Password = ?")) {
	 	 $stmt->bind_param("ss", $_SESSION['username'],$_SESSION['password']);
		/* execute query */
	    $stmt->execute();
	
	    /* bind result variables */
	    $stmt->bind_result($id, $username, $password, $imagepath);
	
	    /* fetch value */
	    $stmt->fetch();
		}
		    $user = new User();
			$user->SetId($id);
			$user->SetUsername($username);
			$user->SetPassword($password);
			$user->SetImagePath($imagepath);
			$selecteduser = $user;
	 	return $selecteduser;
	}
	
	// Loggar in användare
	function DoLogin($username, $password, $cookie){
	 $dbh = new DataBaseHandler();
	
	 $mysqli = $dbh->ConnectToDb();
	 
	 if ($stmt = $mysqli->prepare("SELECT Username FROM Users WHERE Username=? AND Password = ?")) {
	 	 $stmt->bind_param("ss", $username,$password);
		

	    /* execute query */
	    $stmt->execute();
	
	    /* bind result variables */
	    $stmt->bind_result($res);
	
	    /* fetch value */
	    $stmt->fetch();
		if($res){
		$_SESSION['loggedin'] = true;
				if ($cookie === true){
				
					setcookie('username',$username);
					setcookie('password',$password);
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
				}
		}
	    /* close statement */
	    $stmt->close();
		}
	
	/* close connection */
	$mysqli->close();
		 
				
		
		
	}
	
	// Loggar ut användare
	function DoLogout(){
		
		$_SESSION['loggedin'] = false;
		setcookie('username','', time() - 3600);
		setcookie('password','', time() - 3600);
		
	}
	
	function Test(){
		
		$dbh = new DataBaseHandler();
		$error = "";
		if($dbh->ConnectToDb($error) != null){
			echo "Connection OK ";
		}
		else{
			echo "Fel på databasuppkoppling " . $error;
		}
		
			
			
		
		// Logga ut 
		$this->DoLogout();
		
		// testa ifall vi är inloggade
		if($this->IsLoggedIn()){
			echo "Vi är inloggade trots att vi inte borde vara det";
			return false;
		}
		// logga in med felaktiga uppgifter
		$this->DoLogin("fel", "fel", false);
			if($this->IsLoggedIn()){
			echo "Vi är inloggade trots att vi inte borde vara det";
			return false;
		}
		// logga in med rätt uppgifter utan cookie
		$this->DoLogin("user", "pass", false);
		if(!$this->IsLoggedIn()){
			echo "Vi loggades inte in trots att vi borde  det";
			return false;
		}
		
		$this->DoLogout();
		if($this->IsLoggedIn()){
			echo "Vi är inloggade trots att vi loggat ut";
			return false;
		}
		
		
		return true;
		}
	
	}
	
	
