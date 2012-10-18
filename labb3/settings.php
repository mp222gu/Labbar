<?php

class Settings{

	public static $dataBaseSettings = array(
	
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'tablename' => 'labbar'
		
	);
	
	public static function GetDatabaseSettings(){
		
		return self::$dataBaseSettings;
	}
	public static function GetImagePath($path){
		return dirname(realpath(__FILE__)) . '\\img\\';
		
		
	}


}