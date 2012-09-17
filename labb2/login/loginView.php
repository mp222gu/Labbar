<?php

 class loginView{
 		
 	private $loggedinSession = "loggedin";
	private $testUserName = "user";
	private $testPassword = "pass";
	private $usernameCookie = "username";
	private $passwordCookie = "password";
	private $loginCookie = "login";
	private $logoutCookie = "logout";
	
	function DoLoginBox(){
		
		$output = '';
		$output.= "<form action='index.php' >";
		$output.= "<label>Username</label> ";
		$output.= "<input type='textbox' name='username'/> "; 
		$output.= "<label>Password</label> ";
		$output.= "<input type='textbox' name='password'/> "; 
		$output.= "<label>Remeber me</label> ";
		$output.= "<input type='checkbox' name='remember'class='checkbox' />"; 
		$output.= "<input type='submit' name='login' value='Log in' class='submit'/>"; 
		
		$output.= "</form>";
		return $output;
	}
	
	function DoLogoutBox(){
		$output = '';
		$output.= "<form action='index.php' >";
		$output.= "<input type='submit' name='logout' value='Log out' id='logoutbutton'/>";
		$output.= "</form>";
		return $output;
		
	}
	
	function TriedToLogin(){
		if (ISSET($_GET[$this->loginCookie])){
			return true;
		}
		return false;
	}
	function TriedToLogout(){
		if (ISSET($_GET[$this->logoutCookie])){
			return true;
		}
		return false;
	}
	function GetUserName(){
		if (ISSET($_GET[$this->usernameCookie])){
			return $_GET[$this->usernameCookie];
		}
		return '';
	}
	function GetPassword(){
		if (ISSET($_GET[$this->passwordCookie])){
			return $_GET[$this->passwordCookie];
		}
		return '';
	}
	
}



