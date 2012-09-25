<?php
require_once 'login/LoginController.php';
require_once 'login/LoginHandler.php';
require_once '/login/LoginView.php';
require_once '/Controllers/registerController.php';
require_once '/Models/userModel.php';
require_once '/Views/registerView.php';
require_once '/Views/uploadView.php';
require_once '/Controllers//userController.php';
require_once 'Page.php';
require_once 'databaseHandler.php';


session_start();

class MasterController{
	
	public function DoControll(){
		$db = new DatabaseHandler();
		$lh = new LoginHandler($db);
		$lv = new LoginView();
		$lc = new LoginController();
		$rc = new RegisterController();
		$uh = new UserHandler($db);
		$rv = new RegisterView();
		$uc = new UserController();
		$upv = new UploadView();
		$uv = new UserView();
		$controllerString = "controller";
		$loginControllerString = "login";
		$userControllerString = "user";
		$registerControllerString = "register";
		$output = '';
		$registeroutput = '';
		
	    $user =	$lh->IsLoggedIn()? $lh->GetLoggedinUser() : null;
		
		if(isset($_GET[$controllerString])){
			switch($_GET[$controllerString]){
				case $loginControllerString : {
					$output = $lc->DoControl($lv, $lh);
					break;
				}
				case $registerControllerString : {
					$registeroutput = $rc->DoControl($rv, $uh, $user);
					
					break;
				}
				case $userControllerString : {
					
					$output = ($user != null)? $uc->DoControl($user) : $lc->DoControl($lv, $lh);
				
				break;
				}
				
				}
		return $output . $registeroutput;
		}
		else {
			header( 'Location: index.php?controller=user' ) ;
		}
	}
}

$mc = new MasterController();
$body = '';
$body .= $mc->DoControll();
$page = new Page();
echo $page->GetXHTMLpage('Labb 3' , $body);


