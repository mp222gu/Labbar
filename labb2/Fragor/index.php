<?php
require_once('../page.php');
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
$page = new Page();
$body = "";
$body .= "Fråga tre " . "</br>";
$body .= CheckInt(3);
$body .=  CheckInt(3.5);
$body .= CheckInt("tre");
$body .=  CheckString(3);
$body .=  CheckString(3.5);
$body .=  CheckString("tre");
$set = '';
if (isset($set))
$body .= "set </br>";
unset($set);
if (!isset($set))
$body .= "unset" . "</br>";;
$body .=  gettype(3) . "(3)</br>";
$body .=  gettype(3.5) . "(3.5)</br>";
$body .=  gettype("tre") . "(tre)</br>";
$body .=  CheckNumeric(3);
$body .=  CheckNumeric(3.5);
$body .=  CheckNumeric("tre");




// 4.
/**
 *   enkelfnuttar $s
 *   dubbelfnuttad sträng
 */

echo $page->GetXHTMLpage('frågor', $body);
