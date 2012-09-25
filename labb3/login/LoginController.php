<?php

require_once 'LoginHandler.php';
require_once 'LoginView.php';



class LoginController{
// skapar variabler 
private $usernameCookie = "username";
private $passwordCookie = "password";
/*
 * Skapar logiken för login
 */	
  	public function DoControl(LoginView $lv, LoginHandler $lh){
		
		$output = '';
		
	    // först kontrolleras om vi redan är inloggade
	    if ($lh->DoLogin($lv->GetUsername(), $lv->GetPassword())){
		// om vi har försökt logga ut
			if($lv->TriedToLogout()){ 
				$lh->DoLogout();
				$output = $lv->DoLoginBox(true);
				return $output;
			}
			
			else{
			        $lv->SetCookies($lv->GetUsername(),$lv->GetPassword(), 3600);
					header( 'Location: index.php?controller=user' ) ;
			}
		}
		// om vi inte är inloggade från början 
		else{
			// om vi har försökt logga in 
	         if($lv->TriedToLogin()){
	         	
				
				 // testa om loginförsöket lyckades
	         	if($lh->DoLogin($lv->GetUsername(), $lv->GetPassword())){
				
				     $lv->SetCookies($lv->GetUsername(),$lv->GetPassword(), 3600);
					 header( 'Location: index.php?controller=user' ) ;
				}
				else{
					$output =  $lv->DoLoginBox(false);
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
