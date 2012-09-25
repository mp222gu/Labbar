<?php

 class loginView{
	
	function DoLoginBox(){
		
		$output = '';
		$output.= "<form action='index.php' >";
		$output.= "<input type='hidden' name='controller' value='login'/>";
		$output.= "<label>Username</label> ";
		$output.= "<input type='textbox' name='username'/> "; 
		$output.= "<label>Password</label> ";
		$output.= "<input type='textbox' name='password'/> "; 
		$output.= "<label>Remeber me</label> ";
		$output.= "<input type='checkbox' name='remember'class='checkbox' />"; 
		$output.= "<input type='submit' name='login' value='Log in' class='submit'/>"; 
		$output.= "<a class='clear' href='index.php?controller=register'>Create new user</a>";
		$output.= "</form>";
		
		return $output;
	}
	
	function DoLogoutBox(){
		$output = '';
		$output.= "<form class='logoutform' action='index.php' >";
		$output.= "<input type='hidden' name='controller' value='login'/>";
		$output.= "<input type='submit' name='logout' value='Log out' id='logoutbutton'/>";
		$output.= "</form>";
		return $output;
		
	}
	
	function TriedToLogin(){
		if (ISSET($_GET['login'])){
			return true;
		}
		return false;
	}
	function TriedToLogout(){
		if (ISSET($_GET['logout'])){
			return true;
		}
		return false;
	}
	function GetUserName(){
		if (ISSET($_GET['username'])){
			return $_GET['username'];
		}
		return '';
	}
	function GetPassword(){
		if (ISSET($_GET['password'])){
			return $_GET['password'];
		}
		return '';
	}
	function CheckedRememberMe(){
		
	if(ISSET($_GET['remember'])){
		return true;
	}
	else{
		return false;
	}
	}
}



