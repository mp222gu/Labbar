<?php
require_once('login/loginController.php');
require_once('page.php');
session_start();
$lc = new LoginController();
$lh = new LoginHandler();
$title = "Labb 2";
$body = $lc->DoControl($lh);	
$page = new Page();	
			
	    
echo $page->GetXHTMLpage($title, $body);
