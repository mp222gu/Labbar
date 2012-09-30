<?php
require_once('/Views/uploadView.php');
require_once('routing.php');
class RegisterController{
	
	
	public function DoControl($rv, $um, $user){
		$upv = new UploadView();
		$userError = '';
		$passError = '';
		$uploadError = '';
		
		$output = '';
		$img = "";
		$output = '<h1>Register Controller</h1>';
		if($rv->TriedToRemove()){
			$um->DeleteUser($rv->GetRemoveId());
		}
		if($rv->TriedToRegister() == true){
			
			
			$um->CreateUser($rv->GetUsername($userError),$rv->GetPassword($passError), $rv->GetImage() );
			
			Routing::ChangeController('user');
		}
		if($upv->TriedToUpload()){
				$imgpath = $upv->MoveFile($error);
				$output .= "<div class='errordiv'>" . $error . "</div>";
				$uh->AddImageToUser($imgpath);
				$img = $imgpath;
				
			}
		$output.= $rv->DoRegisterForm($userError, $passError, $img);
		
			
		$output.= $upv->DoUploadForm($uploadError);
		if($user == 'admin'){
			
			$output.= $uv->DoUserList($uh->GetAllUsers());
		}
		
		
			
			
		
		
		return $output;
	
	}
	
}
