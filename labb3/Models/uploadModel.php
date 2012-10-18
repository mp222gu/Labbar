<?php 

namespace Model; 
require_once ('/common/errormessages.php');

class UploadModel{
	 
	private $targetFile; 
	private $uploadMessage;
	private $errorString = 'error';
	private $nameString = 'name';
    private $tmpNameString = 'tmp_name';
	private $errorList = array();
	private $targetPath = 'Files/';
	
	
	public function SaveFile($uploadedFiles, $filename){
			
				
				
				$this->targetFile = $this->targetPath . basename( $uploadedFiles[$filename][$this->nameString]); 
				
				if(move_uploaded_file($uploadedFiles[$filename][$this->tmpNameString], $this->targetFile)) {
					
				 
				} 
				else{
					
					$this->errorList[] = "There was an error uploading the file";
					switch($uploadedFiles[$filename][$this->errorString]){
						
						case 1:  $this->errorList[] = \Common\ErrorMessage::GetErrorMessage(2000);
						break;
						
						case 2:  $this->errorList[] = \Common\ErrorMessage::GetErrorMessage(2000);
						break;
						
						case 3:  $this->errorList[] = \Common\ErrorMessage::GetErrorMessage(2001);
						break;
						
						case 4:  $this->errorList[] = \Common\ErrorMessage::GetErrorMessage(2002);
						break;
						
					}
				    
				}
			
		
	}
	public function GetTargetFile(){
	
		
		return $this->targetFile;
	}
	public function GetErrorList(){
		
		
		return $this->errorList;
			
	}
		
	
}
