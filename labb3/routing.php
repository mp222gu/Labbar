<?php

class Routing{
	
	
	public static function ChangeController($controller){
		
		header( 'Location: index.php?controller=' . $controller ) ;
	}
}
