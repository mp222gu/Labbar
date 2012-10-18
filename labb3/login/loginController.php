<?php
namespace Controller;

require_once 'LoginHandler.php';
require_once 'LoginView.php';

class LoginController{
// skapar variabler 
private $usernameCookie = "username";
private $passwordCookie = "password";
	/**
	 * @return html
	 */	
  	public function DoControl(\View\LoginView $lv, \Model\LoginHandler $lh){
		
		$output = '';
		
	    // först kontrolleras om vi redan är inloggade
	   	$ret = $lh->DoLogin($lv->GetUsername(), $lv->GetPassword());
	    if ($ret === true){
		// om vi har försökt logga ut
			if($lv->TriedToLogout()){ 
				$lh->DoLogout();
				$output = $lv->DoLoginBox(true);
				
				return $output;
			}
			
			else{
			        $lv->SetCookies($lv->GetUsername(),$lv->GetPassword(), 3600);
					\View\NavigationView::GetUserController();
			}
		}
		// om vi inte är inloggade från början 
		else{
			 // om vi har försökt logga in 
	         if($lv->TriedToLogin()){
	         	
				// testa om loginförsöket lyckades
				$ret = $lh->DoLogin($lv->GetUsername(), $lv->GetPassword());
				
	         	if($ret === true){
				
				     $lv->SetCookies($lv->GetUsername(),$lv->GetPassword(), 3600);
					 \View\NavigationView::GetUserController();
				}
				else{
					
					$output =  $lv->DoLoginBox($ret);
				 	return $output;
				}
	
			 }
			 // om vi inte har försökt logga in
			 else{
				$output = $lv->DoLoginBox(true);
				 return $output;
			 }
		}
		return $output;
	}
}
