<?php
 class Page{
	public function GetXHTMLpage($title, $body){
	$output = "";
	$output .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'
	        .  '<html xmlns="http://www.w3.org/1999/xhtml">'
	    	.  '<head>'
	    	.  '<title>'
	    	.  $title 
	    	.  '</title>'
	   		.  '<meta http-equiv="content-type" content="text/html; charset=utf-8" />'
	   		.  '<link rel="stylesheet" href="Style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>'
	        .  '</head>'
	  		.  '<body class="">'
	  		. $body
	        . '</body>'
			. '</html>';
	return $output;
	
	}
 }