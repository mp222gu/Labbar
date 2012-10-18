<?php
namespace View;

require_once ('formView.php');

	class UploadView{
		
	/**
	 * @return html
	 */
		function DoUploadForm($error){
			
			$fb = new FormView();
			$output = "";
			$fb->BuildControllerField('register');
			$fb->BuildHiddenField('MAX_FILE_SIZE', 100000);
			$fb->BuildLabel('Choose File to Upload');
			$fb->BuildFileInput('uploadedfile');
			$fb->BuildSubmitButton('uploadfile', 'Upload File', 'Right');
			$output .= $error;
			$output .= $fb->BuildForm('post', 'index.php?controller=register' , 'multipart/form-data');
			
			return $output;  
		}
		/**
		 * @return boolean
		 */
		function TriedToUpload(){
			
			if(isset($_FILES['uploadedfile'])){
				
				return true;
			}
			return false;
		}
		/**
		 * @return string
		 */
		function MoveFile(&$message){
			if(isset($_FILES['uploadedfile'])){
				
				$target_path = "Files/";
				$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
				
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
					
				    $message = "The file ".  basename( $_FILES['uploadedfile']['name']). 
				    " has been uploaded";
				} 
				else{
					
				    $message = "There was an error uploading the file, please try again!";
				}
			}
			return $target_path;
		}
	}
