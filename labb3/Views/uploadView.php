<?php
namespace View;

require_once ('formView.php');


	class UploadView{
	private $maxFileSize = 100000; 
	private $uploadedFileName = 'avatar';
	
	/**
	 * @return html
	 */ 
	 	
		
		
	 
		function DoUploadForm(){
			
			$fb = new FormView();
			$output = "";
			$output .= "<div class='errordiv'>";
			
			$output.= "</div>";
			$fb->BuildControllerField('register');
			$fb->BuildHiddenField('MAX_FILE_SIZE', $this->maxFileSize);
			$fb->BuildLabel('Choose File to Upload');
			$fb->BuildFileInput($this->uploadedFileName);
			$fb->BuildSubmitButton('uploadfile', 'Upload File', 'Right');
		
			$output .= $fb->BuildForm('post', 'index.php?controller=register' , 'multipart/form-data');
			
			return $output;  
		}
		/**
		 * @return boolean
		 */
		function TriedToUpload(){
			
			if(isset($_FILES[$this->uploadedFileName])){
				
				return true;
			}
			return false;
		}
		/**
		 * @return string
		 */
		
		function GetUploadMessage(){
			
			return $this->uploadMessage;
		}
		function  GetUploadedFiles(){
			
			if (isset($_FILES)){
				
				return $_FILES;
			}
			return null;
		}
		function GetUploadFileName(){
			
			return $this->uploadedFileName;
		}
	}
