<?php
require_once('/views/formView.php');
 class loginView{
 	// skapa variablar	
 	private $loggedinSessionString = "loggedin";
	private $usernameString = "username";
	private $passwordString = "password";
	private $loginString = "login";
	private $logoutString = "logout";
	private $remembermeString = "remember";
	
	/*
	 *  Skapar html för loginboxen
	 */
	function DoLoginBox($valid){
		$fb = new FormView();
		$output = '';
		if($valid == false){
		$output.= "<h2 class='loginerror'>Wrong username or password </h2></br> ";
		}
		$fb->BuildControllerField('login');			
		$fb->BuildTextBoxWithLabel($this->usernameString);
		$fb->BuildTextBoxWithLabel($this->passwordString);
		$fb->BuildCheckBoxWithLabel($this->remembermeString, 'checkbox');
		$fb->BuildSubmitButton($this->loginString, 'Log in', 'submit');
		$fb->BuildLink('Create new user',  'index.php?controller=register', 'submit');
		$output .= $fb->BuildForm();
		
		return $output;  
	}
	
	/*
	 *  Skapar html för logoutboxen
	 */
	function DoLogoutBox(){
		$fb = new Formbuilder();
		
		$output = '';
		$output.= "<h2 class='loginok'>Logged in</h2></br>";
		$fb->BuildControllerField('login');	
		$fb->BuildSubmitButton($this->logoutString,  'Log out', 'submit');
		$output.= $fb->BuildForm('get');
		return $output;
		
	}
	function SetCookies($username, $password, $time){
		
		setcookie($this->usernameString, $username, time() + $time);
	    setcookie($this->passwordString, $password, time() + $time);
	}
	// Kollar olika input från användaren 
	function TriedToLogin(){
			if (ISSET($_GET[$this->loginString])){
			
			if ($this->CheckedRememberMe()){
			
		}
				
			return true;
		}
		return false;
	}
	function TriedToLogout(){
		if (ISSET($_GET[$this->logoutString])){
			if(ISSET($_COOKIE[$this->usernameString])){
				setcookie($this->usernameString, "", time() - 3600);
			    setcookie($this->passwordString, "", time() - 3600);
			}
			return true;
		}
		return false;
	}
	function GetUserName(){
		if (ISSET($_COOKIE[$this->usernameString])){
			return $_COOKIE[$this->usernameString];
		}
		else{
			if (ISSET($_GET[$this->usernameString])){
				return $_GET[$this->usernameString];
			}
		}
		return '';
	}
	function GetPassword(){
		if (ISSET($_COOKIE[$this->passwordString])){
			return $_COOKIE[$this->passwordString];
		}
		else{
			if (ISSET($_GET[$this->passwordString])){
				return $_GET[$this->passwordString];
			}
		}
		return '';
	}
	function CheckedRememberMe(){
		if(ISSET($_GET[$this->remembermeString])){
		
			
			return $_GET[$this->remembermeString];
		}
		
		
	}
	
}



