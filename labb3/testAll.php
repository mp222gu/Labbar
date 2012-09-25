<?php 
require_once('page.php');
require_once('login/loginHandler.php');
session_start();

/*
 *  Class för tester av applikationen
 */
class Test{
	/*
	 * funktion som testar loginfunktionaliteten , de fel som genereras hamnar i 
	 * errorvariabeln och visas på en felsida
	 *
	 */
	function TestLogin($db){
		$lh = new LoginHandler($db);
		$page = new Page();
		$title = "test";
		$error = "";
		// Logga ut 
		$lh->DoLogout();
		
		// testa ifall vi är inloggade
		if($lh->IsLoggedIn()){
			$error .= " Vi är inloggade trots att vi inte borde vara det </br>";
			
		}
		// logga in med felaktiga uppgifter
		$lh->DoLogin("fel", "fel");
			if($lh->IsLoggedIn()){
			$error .= " Vi är inloggade trots att vi inte borde vara det</br>";
			
		}
		// logga in med rätt uppgifter
		$lh->DoLogin("test", "testtest");
		if(!$lh->IsLoggedIn()){
			$error .= " Vi loggades inte in trots att vi borde  det </br>";
			
		}
		$lh->DoLogout();
		if($lh->IsLoggedIn()){
			$error .= " Vi är inloggade trots att vi loggat ut </br>";
		
		}
		if ($error == "" ){
			$error .= "</br><h2>logintester OK</h2>";
		}
		return  $error;
	}
	public function TestDB(DatabaseHandler $db){
		
		$error = "";
		
		
		$error = "Tester på databaser misslyckade";
		
		return $error;
	}
}
// skapar en sida som visar felen
$page = new Page();
$t = new Test();
$db = new DatabaseHandler();
$body = "";
$body .= $t->TestLogin($db);
$body .= $t->TestDB($db);
echo $page->GetXHTMLpage('testsida', $body);
