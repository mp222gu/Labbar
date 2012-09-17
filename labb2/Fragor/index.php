<?php

// 3.


function CheckInt($input) {
		
	if(is_int($input))  
		return $input . " är en integer " . "</br>";
		return $input . " är ingen integer " . "</br>";
}
function CheckString($input) {
		
	if(is_string($input))  
		return $input . " är en string  " . "</br>";
		return $input . " är ingen string " . "</br>";
}
function CheckNumeric($input) {
		
	if(is_numeric($input))  
		return $input . " är numerisk  " . "</br>";
		return $input . " är inte numerisk " . "</br>";
}
echo "Fråga tre " . "</br>";
echo  CheckInt(3);
echo  CheckInt(3.5);
echo  CheckInt("tre");
echo  CheckString(3);
echo  CheckString(3.5);
echo  CheckString("tre");
$set = '';
if (isset($set))
echo "set </br>";
unset($set);
if (!isset($set))
echo "unset" . "</br>";;
echo  gettype(3) . "(3)</br>";
echo  gettype(3.5) . "(3.5)</br>";
echo  gettype("tre") . "(tre)</br>";
echo  CheckNumeric(3);
echo  CheckNumeric(3.5);
echo  CheckNumeric("tre");




// 4.
/**
 *   enkelfnuttar $s
 *   dubbelfnuttad sträng
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>Labbfrågor</title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  </head>
  <body >
  	<form action='?' >
  	<input type="text" name="input"/>
  	<input type="submit" value="submit"/>	
  		
  	</form>
  </body>
  </html>