<?php
require_once '/Models/userModel.php';
require_once '/Models/user.php';
require_once '/views/formView.php';
require_once 'settings.php';

class RegisterView{
private $usernameString = "Username";
private $passwordString = "Password";
private $registerString = "register";
private $removeString = "remove";
private $imageString = "image";
	
	
	function DoRegisterForm($userError, $passError, $img){
		$fb = new FormView();
		$settings = new Settings();
		$output = '';
		
		$fb->BuildControllerField($this->registerString);
		$fb->BuildTextBoxWithLabel($this->usernameString);
		$fb->BuildTextBoxWithLabel($this->passwordString);
		$fb->BuildSubmitButton($this->registerString, $this->registerString, 'submit');
		$fb->BuildImage($img);
		$fb->BuildHiddenField($this->imageString , $img);
		$output = $fb->BuildForm();
		
		return $output;
	}
	
	
	function TriedToRegister(){
		
		if(ISSET($_GET[$this->registerString])){
	
			return true;
		}
		
		return false;
	}
	function TriedToRemove(){
		
		if(ISSET($_GET[$this->removeString])){
			return true;
		}
		return false;
	}
	function GetRemoveId(){
		
		if(isset($_GET[$this->removeString])){
			return $_GET[$this->removeString];
		}
		return '';


	
	}
	function GetUsername(&$error){
		
		if(ISSET($_GET[$this->usernameString])){
			if ($_GET[$this->usernameString] != ""){
			return $_GET[$this->usernameString];
			}
			$error.= "Username required ";
		}
		return '';
	}
    function GetPassword(&$error){
		
		if(ISSET($_GET[$this->passwordString])){
			if ($_GET[$this->passwordString] != ""){
			return $_GET[$this->passwordString];
			}
			$error.= "Password needs to be at least 6 characters ";
		}
		return '';
	}
	function GetImage(){
		
		if(ISSET($_GET[$this->imageString])){
			if ($_GET[$this->imageString] != ""){
			return $_GET[$this->imageString];
			}
			
		}
		return '';
	}
}
