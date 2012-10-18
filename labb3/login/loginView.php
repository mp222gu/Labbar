<?php
namespace View;

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
		$fb = new \View\FormView();
		$output = '<form method="get" action="index.php">';
		if($valid === false){
			$output.= "<h2 class='loginerror'>Wrong username or password </h2></br> ";
		}
		
		$output.= "<input type='hidden' name='controller' value='login'"	
				. "<div class='formrow' >"		
				. "<label>$this->usernameString</label>"
				. "<input type='text' name='$this->usernameString'  />"
				. "</div>"
				. "<div class='formrow' >"
				. "<label>$this->passwordString</label>"
				. "<input type='password' name='$this->passwordString' />"
		       	. "</div>"
		       	. "<div class='formrow' >"
		        . "<label>$this->remembermeString</label>"
				. "<input type='checkbox' name='$this->remembermeString' value='$this->remembermeString' class='checkbox'/>"
				. "<input type='submit' name='$this->loginString'  value='Log in' class='submit'"
				. "</div>"
				. "<a href='index.php?controller=register'>Create new user</a>"
				. "</form>";
		
		return $output;  
	}
	
	/**
	 *  @return html
	 */
	function DoLogoutBox(){
		$fb = new \View\FormView();
		$output = '';
		$fb->BuildLabel('Logged in');
		$fb->BuildControllerField('login');	
		$fb->BuildSubmitButton($this->logoutString,  'Log out', 'submit');
		$output.= $fb->BuildForm('get');
		
		return $output;
		
	}
	
	function SetCookies($username, $password, $time){
		
		setcookie($this->usernameString, $username, time() + $time);
	    setcookie($this->passwordString, $password, time() + $time);
	    
	}
	/**
	 * @return boolean
	 */
	function TriedToLogin(){
		
			if (ISSET($_GET[$this->loginString])){
			
				return true;
			}
			return false;
	}
	/**
	 * @return boolean
	 */
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
	/**
	 * @retrun string
	 */
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
	/**
	 * @return streing
	 */
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
	/**
	 * @return boolean'
	 * 
	 */
	function CheckedRememberMe(){
		
		if(ISSET($_GET[$this->remembermeString])){
		
			return $_GET[$this->remembermeString];
			
		}
	}
}



