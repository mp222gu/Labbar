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
	function DoLogin($username, $password){
		
		
		
			if(( $username == $this->testUserName) && ($password == $this->testPassword)){
				$_SESSION[$this->loggedinSession] = true;
				return true;
			}
		return false;
		
	}
	
	// Loggar ut användare
	function DoLogout(){
		
		$_SESSION[$this->loggedinSession] = false;
	
		
	}
	
	
		
}
