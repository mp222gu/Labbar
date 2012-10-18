<?php

namespace View;
class NavigationView{
	
	const baseString = "Location: index.php?controller=";
	const userControllerString = "user";
	const adminControllerString = "admin";
	const registerControllerString = "register";
	const loginControllerString = "login";
	
	public static function GetAdminController(){
		
		header(self::baseString . self::adminControllerString);
	}
	public static function GetUserController(){
		
		header (self::baseString . self::userControllerString);
	}
	public static function GetRegisterController(){
		
		header (self::baseString . self::registerControllerString);
	}
	public static function GetLoginController(){
		
		header (self::baseString . self::loginControllerString);
	}
	public function GetController(){
		
		if (isset($_GET['controller'])){
			
			return $_GET['controller'];
		}
		return "";
	}
	public static function GetAdminControllerString(){
		
		return self::adminControllerString;
	}
	public static function GetUserControllerString(){
		
		return self::userControllerString;
	}
	public static function GetRegisterControllerString(){
		
		return self::registerControllerString;
	}
	public static function GetLoginControllerString(){
		
		return self::loginControllerString;
	}

}
