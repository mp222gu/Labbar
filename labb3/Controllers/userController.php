<?php
require_once("/Views/userView.php");
require_once("/login/loginView.php");

class UserController{
	public function DoControl($user){
		
		$lv = new LoginView();
		$uv = new UserView();
		$output = "";
		$output.= $uv->DoUserControlPanel($user);
		$output.= $lv->DoLogoutBox();
		return $output;
	}

}
