<?php
namespace Model;
require_once('/Common/validation.php');

class User{
	
	private $username;
	private $password;
	private $id;
	private $imagepath;
	private $validator;
	
	public function __construct($id,  $username ,  $password,  $imagepath){
		
		$this->validator = \Common\Validator::GetInstance();
		
		$this->id = $id;
		if($this->validator->ValidateUsername($username)){
			$this->username = $username;
		}
		if($this->validator->ValidatePassword($password)){
			$this->password = $password;
		}
		$this->imagepath = $imagepath;
	}
	
	public function SetUsername( $username){
		
		if($this->validator->ValidateUsername($username)){
			$this->username = $username;
		}
	}
	public function SetPassword( $password){
		
		if($this->validator->ValidatePassword($password)){
			$this->password = $password;
		}
	}
	public function SetId($Id){
		
		$this->id = $Id;
	}
	public function GetUsername(){
		
		if($this->validator->ValidateUsername($this->username)){
			return $this->username;
		}
	}
	public function GetPassword(){
		
		if($this->validator->ValidatePassword($this->password)){
			return $this->password;
		}
	}
	public function GetId(){
		
		return $this->id;
	}
	public function GetImagePath(){
		
		return $this->imagepath;
	}
	public function SetImagePath($img){
		
		$this->imagepath = $img;
	}
	
}
class UserList{
	
	
	
}
