<?php
	//länka in filer med funktioner som används
	require_once "math.php";
	require_once "array.php";
	require_once "login/loginHandler.php";
//	require_once "login.php";
?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>Testdriven utveckling</title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  </head>
  <body class="">
  <p>
  	
  	<?php //Här börjar vår php kod.
		echo "<h1>Enhetstester</h1>";

		//Ett avsnitt för varje test
		
		
		//Test av math.php
		echo "<h2>Matematiktest</h2>";
		
		$math = new MathLib();
		if ($math->Test() == true) {
			echo "<p>Matematiktest ok</p>";
		} else {
			echo "<p>Matematiktest fungerar ej</p>";
		}

    //Test av array.php		
		//Ni skall själva implementera funktionerna i array.php
		echo "<h2>Array-test</h2>";
		
		$aHandler = new ArrayHandler();
		if ($aHandler->Test() == true) {
			echo "<p>Arraytest ok</p>";
		} else {
			echo "<p>Arraytest fungerar ej</p>";
		}
		
		//Test av login.php
		//Implementera själv både funktioner och test
		echo "<h2>Login-test</h2>";
		$lh = new LoginHandler();
		if($lh->Test())	{
			echo "<p>Logintest ok</p>";
			
		}
		else {
			echo "<p>Logintest fungerar ej</p>";
		}
		
	?>
  </p>
  </body>
</html>
