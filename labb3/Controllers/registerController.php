<?php
namespace Controller;

require_once('/Views/uploadView.php');
require_once('Views/navigationView.php');

class RegisterController{
	
	/*
	 * @return html
	 */
	public function DoControl(\View\RegisterView $rv,\Model\UserModel $um){
		
		$upv = new \View\UploadView();
		
		$uploadError = '';
		$output = '';
		$img = "";
				
		if($rv->TriedToRemove()){
			
			$um->DeleteUser($rv->GetRemoveId());
			
		}
		if($rv->TriedToRegister() == true){
			
				if($um->CreateUser($rv->GetUsername(),$rv->GetPassword(), $rv->GetImage())){
					\View\NavigationView::GetUserController();
				}
				
		}
		if($upv->TriedToUpload()){
			
				$imgpath = $upv->MoveFile($error);
				$uh->AddImageToUser($imgpath);
				$img = $imgpath;
				
			}
		$output.= $rv->DoRegisterForm($img);
		$output.= $upv->DoUploadForm($uploadError);
						
		return $output;	
	}	
}
