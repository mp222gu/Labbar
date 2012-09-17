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
	function TestLogin(){
		$lh = new LoginHandler();
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
		$lh->DoLogin("fel", "fel", false);
			if($lh->IsLoggedIn()){
			$error .= " Vi är inloggade trots att vi inte borde vara det</br>";
			
		}
		// logga in med rätt uppgifter
		$lh->DoLogin("user", "pass", false);
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
		return $page->GetXHTMLpage($title, $error);
	}
}
// skapar en sida som visar felen
$page = new Page();
$t = new Test();
echo $page->GetXHTMLpage('testsida', $t->TestLogin());
