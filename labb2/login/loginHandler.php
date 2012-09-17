<?php

    
class LoginHandler{
// skapa variablar
private $loggedinSession = "loggedin";
private $testUserName = "user";
private $testPassword = "pass";
private $usernameCookie = "username";
private $passwordCookie = "password";

	// Kollar ifall användare är inloggad	
	function IsLoggedIn(){
		
		if(ISSET($_SESSION[$this->loggedinSession]) && ($_SESSION[$this->loggedinSession] == true)){
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
		$_COOKIE[$this->usernameCookie] = "";
	    $_COOKIE[$this->passwordCookie] = "";
		
	}
	
	
		
}
