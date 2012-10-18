<?php
namespace Controller;

require_once("/Views/userView.php");
require_once("/Login/loginView.php");

class UserController{
	/**
	 * @return html
	 */
	public function DoControl(\Model\User $user){
		
		$lv = new \View\LoginView();
		$uv = new \View\UserView();
		$output = "";
		$output .= $uv->DoUserControlPanel($user);
		$output .= $lv->DoLogoutBox();
		
		return $output;
	}

}
