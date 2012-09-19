<?php

 class loginView{
 	// skapa variablar	
 	private $loggedinSession = "loggedin";
	private $testUserName = "user";
	private $testPassword = "pass";
	private $usernameCookie = "username";
	private $passwordCookie = "password";
	private $loginCookie = "login";
	private $logoutCookie = "logout";
	private $remembermeCookie = "remember";
	
	/*
	 *  Skapar html för loginboxen
	 */
	function DoLoginBox($valid){
		
		$output = '';
		if($valid == false){
		$output.= "<h2 class='loginerror'>Wrong username or password </h2></br> ";
		}
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
	
	/*
	 *  Skapar html för logoutboxen
	 */
	function DoLogoutBox(){
		if ($this->CheckedRememberMe()){
			setcookie($this->usernameCookie, $_GET[$this->usernameCookie], time() + 3600);
			setcookie($this->passwordCookie, $_GET[$this->passwordCookie], time() + 3600);
		}
		$output = '';
		$output.= "<h2 class='loginok'>Logged in</h2></br>";
		$output.= "<form action='index.php' >";
		$output.= "<input type='submit' name='logout' value='Log out' id='logoutbutton'/>";
		$output.= "</form>";
		return $output;
		
	}
	// Kollar olika input från användaren 
	function TriedToLogin(){
			if (ISSET($_GET[$this->loginCookie])){
			
			
				
			return true;
		}
		return false;
	}
	function TriedToLogout(){
		if (ISSET($_GET[$this->logoutCookie])){
			if(ISSET($_COOKIE[$this->usernameCookie])){
				setcookie($this->usernameCookie, "", time() - 3600);
			    setcookie($this->passwordCookie, "", time() - 3600);
			}
			return true;
		}
		return false;
	}
	function GetUserName(){
		if (ISSET($_COOKIE[$this->usernameCookie])){
			return $_COOKIE[$this->usernameCookie];
		}
		else{
			if (ISSET($_GET[$this->usernameCookie])){
				return $_GET[$this->usernameCookie];
			}
		}
		return '';
	}
	function GetPassword(){
		if (ISSET($_COOKIE[$this->passwordCookie])){
			return $_COOKIE[$this->passwordCookie];
		}
		else{
			if (ISSET($_GET[$this->passwordCookie])){
				return $_GET[$this->passwordCookie];
			}
		}
		return '';
	}
	function CheckedRememberMe(){
		if(ISSET($_GET[$this->remembermeCookie])){
		
			
			return $_GET[$this->remembermeCookie];
		}
		
		
	}
	
}



