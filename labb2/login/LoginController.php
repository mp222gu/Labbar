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
  	public function DoControl($lh){
		$lv = new LoginView();
		$output = '';
		
	    // först kontrolleras om vi redan är inloggade
		if( $lh->IsLoggedIn()){
		// om vi har försökt logga ut
			if($lv->TriedToLogout()){ 
				$lh->DoLogout();
				$output = $lv->DoLoginBox(true);
				return $output;
			}
			
			else{
				$output =  $lv->DoLogoutBox();
				return $output;
			}
		}
		// om vi inte är inloggade från början 
		else{
			// om vi har försökt logga in 
	         if($lv->TriedToLogin()){
	         	
	         	$lh->DoLogin($lv->GetUsername(), $lv->GetPassword(), $lv->CheckedRememberMe());
				 // testa om loginförsöket lyckades
				if( $lh->IsLoggedIn()){
					
					$output = $lv->DoLogoutBox();
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
