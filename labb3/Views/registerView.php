<?php
require_once '/Models/userModel.php';
require_once '/Models/user.php';
require_once '/views/formView.php';
require_once 'settings.php';

class RegisterView{
private $usernameString = "Username";
private $passwordString = "Password";
private $registerString = "Register";
private $removeString = "remove";
private $imageString = "image";
	
	
	function DoRegisterForm($userError, $passError, $img){
		$fb = new FormView();
		$settings = new Settings();
		$output = '';
		/*$output.= "<form action='index.php' >";
		$output.= "<input type='hidden' name='controller' value='register'/>";
		$output.= "<h2>Register User</h2>";
		$output.= "<label>Username</label>";
		$output.= "<input type='textbox' name='username'/> <p class='error'>".$userError ."</p>"; 
		$output.= "<label>Password</label> ";
		$output.= "<input type='textbox' name='password'/><p class='error'>".$passError ."</p> "; 
	    $output.= "<input type='submit' name='register' value='Register' class='submit'/>"; 
		$output.=  "<img src='" .$img . "'</img>";
		 $output.= "<input type='hidden' name='image' value='". $img ."' />"; 
		$output.= "</form>"; */
		$fb->BuildControllerField($this->registerString);
		$fb->BuildTextBoxWithLabel($this->usernameString);
		$fb->BuildTextBoxWithLabel($this->passwordString);
		$fb->BuildSubmitButton($this->registerString, $this->registerString, 'submit');
		$fb->BuildImage($img);
		$fb->BuildHiddenField($this->imageString , $img);
		$output = $fb->BuildForm();
		
		return $output;
	}
	
	function DoUserList($users){
		$output = '<div id="userlist"><h3>Users</h3><ul>';
		foreach($users AS $user)
		{
			$output.= "<li>" .$user->GetUsername(). "</li><a href='?controller=user&remove=". $user->GetId() . "'>Remove</a><img src='" . $user->GetImage() ."'/>";
			
		}
		$output.= "</ul></div>";
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
