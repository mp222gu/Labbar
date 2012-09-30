<?php
require_once '/Controllers//userController.php';
require_once '/Controllers/registerController.php';
require_once 'Controllers/adminController.php';
require_once 'login/LoginController.php';
require_once 'login/LoginHandler.php';
require_once '/login/LoginView.php';
require_once '/Models/userModel.php';
require_once '/Views/registerView.php';
require_once '/Views/uploadView.php';
require_once '/Views/pageView.php';
require_once '/Models/databaseHandler.php';
require_once 'routing.php';


session_start();

class MasterController{
	private $adminUsername = "Admin";
    private $controllerString = "controller";
    private $loginControllerString = "login";
    private $userControllerString = "user";
	private $registerControllerString = "register";
	private $adminControllerString = "admin";
	
	
	public function DoControll(){
		$db = new DatabaseHandler();
		$lh = new LoginHandler($db);
		$lv = new LoginView();
		$lc = new LoginController();
		$rc = new RegisterController();
		$um = new UserModel($db);
		$rv = new RegisterView();
		$uc = new UserController();
		$upv = new UploadView();
		$uv = new UserView();
		$ac = new AdminController();
		
		$output = '';
		$registeroutput = '';
		
	    $user =	$lh->IsLoggedIn()? $lh->GetLoggedinUser() : null;
		
		if(isset($_GET[$this->controllerString])){
			switch($_GET[$this->controllerString]){
				case $this->loginControllerString : {
			
					$output = $lc->DoControl($lv, $lh);
					break;
				}
				case $this->registerControllerString : {
					$registeroutput = $rc->DoControl($rv, $um, $user);
					
					break;
				}
				case $this->userControllerString : {
					
					if( is_null($user)){
						
						Routing::ChangeController($this->loginControllerString);
					}
					else{ 
						if ($user->GetUsername() == $this->adminUsername){
							
							
							Routing::ChangeController($this->adminControllerString);
						}
						else{
							
							$output = $uc->DoControl($user);
							
						}
					
					}
					break;
				}
				case $this->adminControllerString : {
					
					
					$output = $ac->DoControl();
				}
				
			}
		return $output . $registeroutput;
			}
		else {
		
			Routing::ChangeController($this->userControllerString);
		}
	}
}

$mc = new MasterController();
$body = '';
$body .= $mc->DoControll();
$page = new Page();
echo $page->GetXHTMLpage('Labb 3' , $body);


