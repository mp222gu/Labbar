<?php
require_once ('formView.php');
	class UploadView{
		
		
		function DoUploadForm($error){
			$fb = new FormView();
			$output = "";
		/*$output = '';
		$output.="<form enctype='multipart/form-data' action='index.php?controller=register' method='POST'>";
		$output.='<input type="hidden" name="MAX_FILE_SIZE" value="100000" />';
		$output.='<p>Choose a file to upload: </p><input name="uploadedfile" type="file" />';
		$output.='<input class="right" type="submit" name="uploadfile" value="Upload File" />';
		$output.= '<p>' . $error . '</p>';
		$output.='</form>';  */
		
		$fb->BuildControllerField('register');
		$fb->BuildHiddenField('MAX_FILE_SIZE', 100000);
		$fb->BuildLabel('Choose File to Upload');
		$fb->BuildFileInput('uploadedfile');
		$fb->BuildSubmitButton('uploadfile', 'Upload File', 'Right');
		$output .= $error;
		$output .= $fb->BuildForm('post', 'index.php?controller=register' , 'multipart/form-data');
		
		return $output;  
		}
		
		function TriedToUpload(){
			
			if(isset($_FILES['uploadedfile'])){
				
				return true;
			}
			return false;
		}
		function MoveFile(&$message){
			if(isset($_FILES['uploadedfile'])){
				$target_path = "img/";
				$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
				
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
				    $message = "The file ".  basename( $_FILES['uploadedfile']['name']). 
				    " has been uploaded";
				} else{
				    $message = "There was an error uploading the file, please try again!";
				}
			}
			return $target_path;
		}
	}
