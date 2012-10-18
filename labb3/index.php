<?php
namespace Controller;

require_once '/Controllers/userController.php';
require_once '/Controllers/registerController.php';
require_once 'Controllers/adminController.php';
require_once 'login/LoginController.php';
require_once 'login/LoginHandler.php';
require_once '/login/LoginView.php';
require_once '/Models/userModel.php';
require_once '/Views/registerView.php';

require_once '/Views/pageView.php';
require_once '/Models/databaseHandler.php';
require_once 'Views/navigationView.php';



session_start();

class MasterController{
	private $adminUsername = "Admin";
    private $controllerString = "controller";
    private $loginControllerString = "login";
    
	
	/**
	 * @retrun html
	 */
	public function DoControll(){
		
		$db = new \Model\DatabaseHandler();
		$lh = new \Model\LoginHandler($db);
		$lv = new \View\LoginView();
		$lc = new \Controller\LoginController();
		$rc = new \Controller\RegisterController();
		$um = new \Model\UserModel($db);
		$rv = new \View\RegisterView();
		$uc = new UserController();
		
		$uv = new \View\UserView();
		$ac = new AdminController();
	
		$output = '';
		$registeroutput = '';
	    $user =	$lh->IsLoggedIn()? $lh->GetLoggedinUser() : null;
		
			switch(\View\NavigationView::GetController()){
				
				case \View\NavigationView::GetLoginControllerString() : {
			
					$output = $lc->DoControl($lv, $lh);
					break;
				}
				case \View\NavigationView::GetRegisterControllerString() : {
					
					$registeroutput = $rc->DoControl($rv, $um);
				
					break;
				}
				case \View\NavigationView::GetUserControllerString() : {
					
					if( is_null($user)){
						
						\View\NavigationView::GetLoginController();
					
					}
					else{
						 
						if ($user->GetUsername() == $this->adminUsername){
							
							\View\NavigationView::GetAdminController();
						
						}
						else{
							
							$output = $uc->DoControl($user);							
						}
					}
					
					break;
				}
				case \View\NavigationView::GetAdminControllerString() : {
					
					$output = $ac->DoControl();
					break;
				}
				case "": {
		
					\View\NavigationView::GetUserController();
				}
			}
			
	return $output . $registeroutput;
	}

}

$mc = new MasterController();
$content = '';
$content .= $mc->DoControll();
$page = new \View\Page();
$page->content = $content;
$page->styleSheet = "Stylesheets/Style.css";
$page->AddScript('//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js');
$page->AddScript("Scripts/validation.js");
echo $page->GetXHTMLpage();


