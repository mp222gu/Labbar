<?php
namespace View;

require_once("/Models/user.php");

class UserView{
	
	/**
	* @return html
	*/
	public function DoUserControlPanel(\Model\User $user){
		
		$output = "";
		$output.= "<div id='userPanel'>";
		$output.= "<p>Username: ".$user->GetUsername()."</p>";
		$output.= "<p>Password: ".$user->GetPassword()."</p>";
		$output.= "<p>Image: </p><img src='".$user->GetImagePath()."'/>";
		$output.= "</div>";
		
		return $output;
	}
	/**
	* @return html
	*/
	public function DoUserList($userList){
		
		$output = '';
		$output .= "<ul>";
		foreach($userList as  $user){
			
			$output.= "<li>". $user['Username'] . "<a href='index.php?controller=admin&remove=" .$user['Id'] . "'>Ta bort</a></li>";
		}
		$output .= "</ul>";
		
		return $output;
	}
	/**
	* @return boolean
	*/
	public function TriedToRemove(){
		
		if(ISSET($_GET['remove'])){
			
			return true;
		}
		return false;
	}
	/**
	* @return int
	*/
	public function GetRemoveId(){
		
		if(ISSET($_GET['remove'])){
			
			return $_GET['remove'];
		}
	}
	
}
