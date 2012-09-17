<?php

    
class LoginHandler{

private $loggedinSession = "loggedin";
private $testUserName = "user";
private $testPassword = "pass";
private $usernameCookie = "username";
private $passwordCookie = "password";

	// Kollar ifall användare är inloggad	
	function IsLoggedIn(){
		
		if(ISSET($_SESSION[$this->loggedinSession]) && ($_SESSION[$this->loggedinSession] == "true")){
			return true;
		}
		return false;
	}
	
	// Loggar in användare
	function DoLogin($username, $password, $cookie){
		
		
		
			if(( $username == $this->testUserName) && ($password == $this->testPassword)){
				$_SESSION[$this->loggedinSession] = true;
				if ($cookie == true){
					
					$_COOKIE[$this->usernameCookie] = $username;
					$_COOKIE[$this->passwordCookie] = $password;
				
				}
			}
		
		
	}
	
	// Loggar ut användare
	function DoLogout(){
		
		$_SESSION[$this->loggedinSession] = false;
		
	}
	
	function Test(){
		
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
		// logga in med rätt uppgifter
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
