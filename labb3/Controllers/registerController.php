<?php
namespace Controller;

require_once('/Models/userModel.php');
require_once('/Models/uploadModel.php');
require_once('/Views/uploadView.php');
require_once('Views/navigationView.php');
require_once('/Common/errormessages.php');

class RegisterController{
	
	private $db;
	private $um;
	private $upm;
	private $upv;
	private $img = "";
	
	   
	
	
	public function __construct(){
		
		
		$this->db = new \Model\DatabaseHandler();
		$this->um = new \Model\UserModel($this->db);
		$this->upm = new \Model\UploadModel();
		$this->upv = new \View\UploadView();
	
		
	}
	public function DoControl(\View\RegisterView $rv,\Model\UserModel $um){
		
		
		$valid = array();
		$uploadError = '';
		$output = '';
		
		
	
		if($rv->TriedToRemove()){
			
			$this->um->DeleteUser($rv->GetRemoveId());
			
		}
		if($rv->TriedToRegister() == true){
			if(!$this->um->FindUser($rv->GetUsername(), $rv->GetPassword())){
				if($this->um->CreateUser($rv->GetUsername(),$rv->GetPassword(), $this->upc->GetSavedImage())){
					\View\NavigationView::GetUserController();
				}
				else{
					$valid = $um->GetErrors();						
				
				}
				
			}
			else{
				
				$output.= $this->DoUploadControl();
				$this->img = $this->GetSavedImage();
				$valid = array_merge($valid, $this->GetUploadErrors()) ;
			
				$output.= $rv->DoRegisterForm($this->img, $valid);
				
			
				
				return $output;	
			}
				
		}
		$output.= $this->DoUploadControl($this->GetUploadErrors());
		$this->img = $this->GetSavedImage();
		$valid = array_merge($valid, $this->GetUploadErrors()) ;
		
		$output.= $rv->DoRegisterForm($this->img, $valid);
		
			
		
						
		return $output;	
	}	
	
	/*
	 * 
	 * 
	 * UploadController
	 */
	public function DoUploadControl(){
		
		$uploadMessage = "";
		$output = "";
		
		if($this->upv->TriedToUpload()){
								
				$this->SaveImage();	   	
		}
		
		$output.= $this->upv->DoUploadForm($uploadMessage);
		return $output;
		
	
	}
	public function SaveImage(){
		
		
		$uploadedFile = $this->upv->GetUploadedFiles();
		
		if($uploadedFile != null){
			$this->upm->SaveFile($uploadedFile, $this->upv->GetUploadFileName() );
			
		}
	}
	public function GetSavedImage(){
		
		
		return  $this->upm->GetTargetFile();
	}
	public function GetUploadErrors(){
		
		return $this->upm->GetErrorList();
	}
}
