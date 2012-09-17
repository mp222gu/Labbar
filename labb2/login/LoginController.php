<?php

require_once 'LoginHandler.php';
require_once 'LoginView.php';



class LoginController{
	
  

	
	public function DoControl($lh){
		$lv = new LoginView();
		$output = '';
		$output.= '<h2>Login Controller</h2>';
		if(ISSET($_COOKIE['username'])){
			
		$lh->DoLogin($_COOKIE['username'], $_COOKIE['password'], false);
		}
		if( $lh->IsLoggedIn()){
	
			
			if($lv->TriedToLogout()){
				$lh->DoLogout();
				$output = $lv->DoLoginBox();
				return $output;
			}
			else{
				$output = $lv->DoLogoutBox();
				return $output;
			}
		}
		else{
			
	         if($lv->TriedToLogin()){
	         	
	         	$lh->DoLogin($lv->GetUsername(), $lv->GetPassword(), $lv->CheckedRememberMe());
				if( $lh->IsLoggedIn()){
					/*$user = $uh->FindUser($lv->GetUsername());
					$output.= $uv->DoUserControlPanel($user);
					$output.= $lv->DoLogoutBox(); 
					return $output; 
					 * 
					 */
					header('Location: index.php?controller=user');
				}
				else{
					$output = "Wrong username or password ". $lv->DoLoginBox();
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
