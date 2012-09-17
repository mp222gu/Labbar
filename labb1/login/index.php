<?php
require_once('loginView.php');


$lV = new loginView();

$title = '';

$title = 'login page';
$body = $lV->DoLoginBox();
$body.= $lV->DoLogoutBox();
$body.= '<div id="info">';
if ($lV->TriedToLogin() ) 
{
      $body .= "Användaren har klickat på Login med användarnamn ";
      $body .= $lV->GetUserName() . " och lösenord " . $lV->GetPassword();
}
else 
{
      $body .= "Användaren har inte klickat på Loginknappen"; 
}
if ($lV->TriedToLogout() ) 
{
      $body .= "<br/>Användaren har klickat på Logout ";
      
}
else 
{
      $body .= "<br/>Användaren har inte klickat på Logoutknappen"; 
}

$body.= "</div>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>
    <?php
  	echo $title;
  	?>	
   </title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="Style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
  </head>
  <body class="">
  	<?php
  	echo $body;
  	?>
  </body>
</html>