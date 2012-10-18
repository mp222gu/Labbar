<?php 
namespace Controller;

require_once('/Views/userView.php');
require_once('/Login/loginView.php');
require_once('/Models/userModel.php');
require_once('/Models/databaseHandler.php');
require_once('/Views/navigationView.php');

class AdminController{
	
	/**
	 *  @return html
	 */
	public function DoControl(){
		
		$db = new \Model\DatabaseHandler();
		$um = new \Model\UserModel($db);
		$userList = $um->GetAllUsers();
		$uv = new \View\UserView();
		$lv = new \View\LoginView();
		$output = "";
		if($uv->TriedToRemove()){
			
			$this->RemoveUser($um);
			
		}
		$output .= $uv->DoUserList($userList);
		$output .= $lv->DoLogoutBox();
		
		return $output;
	}
	/**
	 *  @return void
	 */
	public function RemoveUser(\Model\UserModel $um){
		
			$uv = new \View\UserView();
			$userId = $uv->GetRemoveId();
			$um->RemoveUser($userId);
			\View\NavigationView::GetAdminController();
			
	} 	
}
