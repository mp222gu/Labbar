<?php 
require_once('/Views/userView.php');
require_once('/login/loginView.php');
require_once('/Models/userModel.php');
require_once('/Models/databaseHandler.php');
require_once '/routing.php';

class AdminController{
	
	public function DoControl(){
		$db = new DatabaseHandler();
		$um = new UserModel($db);
		
		$userList = $um->GetAllUsers();
		$output = "";
		$uv = new UserView();
		$lv = new LoginView();
		if($uv->TriedToRemove()){
			$this->RemoveUser($um);
		}
		$output .= $uv->DoUserList($userList);
		$output .= $lv->DoLogoutBox();
		return $output;
	}
	public function RemoveUser(UserModel $um){
		
		    $uv = new UserView();
		
			$userId = $uv->GetRemoveId();
			$um->RemoveUser($userId);	
			Routing::ChangeController('admin');
			
	}
		
	
}
