<?php

class User{
	
	private $username;
	private $password;
	private $id;
	private $imagepath;
	
	public function __construct($id, $username , $password, $imagepath){
		
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->imagepath = $imagepath;
	}
	
	public function SetUsername($un){
		$this->username = $un;
	}
	public function SetPassword($pw){
		$this->password = $pw;
	}
	public function SetId($Id){
		$this->id = $Id;
	}
	public function GetUsername(){
		return $this->username;
	}
	public function GetPassword(){
		return $this->password;
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
