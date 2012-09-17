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
		$output.= '<h2>Login Controller</h2>';
	    // först kontrolleras om vi redan är inloggade
		if( $lh->IsLoggedIn()){
		// om vi har försökt logga ut
			if($lv->TriedToLogout()){ 
				$lh->DoLogout();
				$output = $lv->DoLoginBox();
				return $output;
			}
			
			else{
				$output = "<h2 class='loginok'>Logged in</h2></br>" . $lv->DoLogoutBox();
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
					
					$output = "<h2 class='loginok'>Logged in</h2></br>" . $lv->DoLogoutBox();
				}
				else{
					$output = "<h2 class='loginerror'>Wrong username or password </h2></br> ". $lv->DoLoginBox();
				 	return $output;
				}
	
			 }
			 // om vi inte har försökt logga in
			 else{
				$output = $lv->DoLoginBox();
				 return $output;
			 }
		}
		return $output;
	}
}
