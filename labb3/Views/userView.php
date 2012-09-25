<?php
require_once("/Models/user.php");

class UserView{
	
	
	public function DoUserControlPanel($user){
		
		$output = "";
		$output.= "<div id='userPanel'>";
		$output.= "<p>Username: ".$user->GetUsername()."</p>";
		$output.= "<p>Password: ".$user->GetPassword()."</p>";
		$output.= "<p>Image: </p><img src='".$user->GetImagePath()."'/>";
		$output.= "</div>";
		return $output;
	}
}
