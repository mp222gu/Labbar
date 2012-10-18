<?php
namespace View;

require_once ('/views/formView.php');
require_once ('/common/settings.php');


class RegisterView{
private $usernameString = "Username";
private $passwordString = "Password";
private $usernameConfirmString = "usernameconfirm";
private $passwordConfirmString = "passwordconfirm";
private $repeatedConfirmpassString = "repeatedpasswordconfirm";
private $registerString = "register";
private $removeString = "remove";
private $imageString = "image";
private $repeatedpassString = "PasswordRepeated";
private $formConfirmString = "formconfirm";
	
	/**
	 * @return html
	 */
	function DoRegisterForm($img, $valid){
		
		$dbSettings = new \Common\DatabaseSettings();
		$output = '';
		foreach($valid AS $key => $value){
			$output .= "<h3>". $value."</h3>";
		}
		$output.= "<form method='get' action='index.php' id='registerform'>" 
				. "<input type='hidden' name='controller' value='$this->registerString'/>"
				. "<label>Avatar</label>"
				. "<img src='$img' alt=''  class='avatar'/>"
				. "<div class='formrow'>"
		        . "<label>$this->usernameString</label>"
		        . "<input type='text' name='$this->usernameString' class='$this->usernameString'/>"
		        . "<div class='$this->usernameConfirmString' ></div>"
		        . '</div>'
		        . "<div class='formrow'>"
		        . "<label>$this->passwordString</label>"
		        . "<input type='password' name='$this->passwordString' class='$this->passwordString' />"
		        . "<div class='$this->passwordConfirmString' ></div>"
		        . '</div>'
		        . "<div class='formrow'>"
		        . "<label>Repeat Password</label>"
		        . "<input type='password' name='$this->repeatedpassString' class=' $this->repeatedpassString' />"
				. "<div class='$this->repeatedConfirmpassString' ></div>"
				. '</div>'
				. "<div class='formrow'>"
				. "<div class='$this->formConfirmString' ></div>"
				. "</div>"
		        . "<input type='submit'  value='$this->registerString' id='registerButton' />"
				
		        . "<input type='hidden' name='$this->imageString' value='$img' />"
		        . "<input type='hidden' name='$this->registerString' value='$this->registerString' />"
		        . "</form>";
		
		
		return $output;
	}
	
	/**
	 * @return boolean
	 */
	function TriedToRegister(){
		
		if(ISSET($_GET[$this->registerString])){
			
			return true;
		}
		
		return false;
	}
	/**
	 * @return boolean
	 */
	function TriedToRemove(){
		
		if(ISSET($_GET[$this->removeString])){
			
			return true;
		}
		return false;
	}
	/**
	 * @return int
	 */
	function GetRemoveId(){
		
		if(isset($_GET[$this->removeString])){
			
			return $_GET[$this->removeString];
		}
		return '';


	
	}
	/**
	 * @return string
	 */
	function GetUsername(){
		
		if(ISSET($_GET[$this->usernameString])){
			
			if ($_GET[$this->usernameString] != ""){
			return $_GET[$this->usernameString];
			}
		
		}
		return '';
	}
	/**
	 * @return string
	 */
    function GetPassword(){
		
		if(ISSET($_GET[$this->passwordString])){
			if ($_GET[$this->passwordString] != ""){
				
				return $_GET[$this->passwordString];
			}
			
		}
		return '';
	}
	/**
	 * @return string
	 */
	function GetImage(){
		
		if(ISSET($_GET[$this->imageString])){
			
			if ($_GET[$this->imageString] != ""){
			return $_GET[$this->imageString];
			}
			
		}
		return '';
	}
	/**
	 * @return string
	 */
	function GetRepeatedPass(){
		
		if(ISSET($_GET[$this->repeatedpassString])){
			
			if ($_GET[$this->repeatedpassString] != ""){
				
				return $_GET[$this->repeatedpassString];
			}
			
		}
		return '';
	}
	
}
