<?php
require_once('/Views/uploadView.php');

class RegisterController{
	
	
	public function DoControl($rv, $uh, $user){
		$upv = new UploadView();
		$userError = '';
		$passError = '';
		$uploadError = '';
		
		$output = '';
		$img = "";
		$output = '<h1>Register Controller</h1>';
		if($rv->TriedToRemove()){
			$uh->DeleteUser($rv->GetRemoveId());
		}
		if($rv->TriedToRegister() == true){
			
			
			$uh->CreateUser($rv->GetUsername($userError),$rv->GetPassword($passError), $rv->GetImage() );
			
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
