<?php
require_once('login/loginController.php');
require_once('page.php');
session_start();
// skapa instanser
$lc = new LoginController();
$lh = new LoginHandler();

// generera delarna av sidan
$title = "Labb 2";
$body = $lc->DoControl($lh);	

// skapa och visa sidan
$page = new Page();	
echo $page->GetXHTMLpage($title, $body);
