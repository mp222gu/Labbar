<?php 
require_once('Views/pageView.php');
require_once('login/loginHandler.php');
require_once ('/Models/databaseHandler.php');
require_once('/Common/validation.php');
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
	
	function TestLogin(\Model\DatabaseHandler $db){
		$lh = new \Model\LoginHandler($db);
		$page = new \View\Page();
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
	public function TestDB(\Model\DatabaseHandler $db){
		
		$error = "";
		
		/*
		 * Test för att hämta ut en användare 
		 */
		$username = "user1";
		$password = "pass1";
		$sql = "SELECT id, username, password, imagepath FROM testusers WHERE username = ? AND password = ?";
	    
	    $stmt = $db->Prepare($sql);
		$stmt->bind_param("ss", $username, $password);
		
		$userList = $db->SelectMany($stmt);
		
		if($userList[0]['username'] != "user1"){
				$error .= " Misslyckades att hämta user1 " ;
			
		}
		/*
		 * Test för att hämta ut alla användare i en lista 
		 */
		$sql = "SELECT id, username, password, imagepath FROM testusers ";
		$stmt = $db->Prepare($sql);
		$userList = $db->SelectMany($stmt);
		if($userList[0]['username'] != "user1"){
				$error .= " Misslyckades att hämta första posten  " ;
			
		}
		if($userList[2]['username'] != "user3"){
				$error .= " Misslyckades att hämta sista posten  " ;
			
		}
		/*
		 * Test av insert
		*/
		$newusername = "newuser";
		$newpassword = "newpass";
		$newimagepath = "newpath";
		
		 $sql = "INSERT INTO testusers (username, password, imagepath) VALUES (?,?,?)";
		
		$stmt = $db->Prepare($sql);
		$stmt->bind_param("sss", $newusername, $newpassword,$newimagepath);
		$db->RunInsertQuery($stmt);
		
		$username = "newuser";
		$password = "newpass";
		$sql = "SELECT id, username, password, imagepath FROM testusers WHERE username = ? AND password = ?";
	    
	    $stmt = $db->Prepare($sql);
		$stmt->bind_param("ss", $username, $password);
		
		$userList = $db->SelectMany($stmt);
		
		if($userList[0]['username'] != "newuser"){
				$error .= " Misslyckades att hämta användare efter insert " ;
			
		}
		
		 /*
		 * 
		 * Test av delete
		 */
		$id = $userList[0]['id'];
		$sql = "DELETE FROM testusers WHERE id = ? ";
		
		 $stmt = $db->Prepare($sql);
		$stmt->bind_param("i", $id);
		$db->RunDeleteQuery($stmt);
		
		$sql = "SELECT username FROM testusers WHERE id = ? ";
	    
	    $stmt = $db->Prepare($sql);
		$stmt->bind_param("i", $id);
		$userList = $db->SelectMany($stmt);
		if($userList){
				$error.= " Fick ut en användare som borde varit borttagen ";
			
		}

		if( $error === "" ){
			$error .= "<h2>Tester på databas OK ! </h2>";
		}
		
		
		
		
		return $error;
	}
}
// skapar en sida som visar felen
$page = new \View\Page();
$t = new Test();
$db = new \Model\DatabaseHandler();
$validator = \Common\Validator::GetInstance();

$body = "";

$body .= $t->TestLogin($db);
$body .= $t->TestDB($db);
$body.= "<h2>tester på validator</h2> <br />";
foreach($validator->Test() AS $key => $value){
			
	$body.= $value;
	
}
$page->content = $body;
echo $page->GetXHTMLpage();
