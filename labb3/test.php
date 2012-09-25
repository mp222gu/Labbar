<?php
require_once 'login/LoginHandler.php';
require_once 'userHandler.php';
require_once 'dataBaseHandler.php';

session_start(); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>Testdriven utveckling</title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="Style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
  </head>
  <body class="">
  	<?php
  	echo "<h1>Enhetstester</h1>";
  	//Test av login.php
		//Implementera själv både funktioner och test
		echo "<h2>Login-test</h2>";
		$lh = new LoginHandler();
		$uh = new UserHandler();
		if($lh->Test())	{
			echo "<p>Logintest ok</p>";
			
		}
		else {
			echo "<p>Logintest fungerar ej</p>";
		}
		if($uh->Test()){
			echo "<p>Usertest ok</p>";
		}
		else{
			
			echo "<p>Usertest fungerar ej</p>";
		}

	
	
  	?>
  </body>
</html>