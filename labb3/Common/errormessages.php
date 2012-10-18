<?php
namespace Common;

class ErrorMessage{
	
	public static function GetErrormessage($code){
		
		switch($code){
			// validation errors 
			case 0:
				return "Wrong email format";
				break;
			case 1:
				return "Wrong username format";
				break;
			case 2:
				return "Wrong password format";
				break;
			// database errors
			case 1000:
				return "Wrong password or username";
				break;
			case 1001:
				return "Username already exists";
				break;
			// upload errors 
			case 2000:	
				return " The file was too large ";
				break;
			case 2001:	
				return " The file was only partially uploaded ";
				 break;
			case 2002:	
				return " No file was uploaded ";
				 break;
				
		}
		
	}
	
}
