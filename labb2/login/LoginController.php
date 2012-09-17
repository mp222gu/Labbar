<?php

require_once 'LoginHandler.php';
require_once 'LoginView.php';



class LoginController{
	
private $usernameCookie = "username";
private $passwordCookie = "password";
	
  	public function DoControl($lh){
		$lv = new LoginView();
		$output = '';
		$output.= '<h2>Login Controller</h2>';
	
		if( $lh->IsLoggedIn()){
	
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
		else{
			
	         if($lv->TriedToLogin()){
	         	
	         	$lh->DoLogin($lv->GetUsername(), $lv->GetPassword(), $lv->CheckedRememberMe());
				if( $lh->IsLoggedIn()){
					
					$output = "<h2 class='loginok'>Logged in</h2></br>" . $lv->DoLogoutBox();
				}
				else{
					$output = "<h2 class='loginerror'>Wrong username or password </h2></br> ". $lv->DoLoginBox();
				 	return $output;
				}
	
			 }
			 else{
				$output = $lv->DoLoginBox();
				 return $output;
			 }
		}
		return $output;
	}
}
