<?php
/*
 *  class för att skapa en xhtml -sida 
 */
namespace View;

	class Page{
		
		public $title;
	 	public $menu;
		public $leftSide;
		public $content;
		public $rightSide;
		public $footer;
		public $styleSheet;
		public $charSet;
		private $scripts = array();

		/**
		 * @return html
		 */
		public function AddScript($url){
			
			$this->scripts[] = "<script type='text/javascript' src='" . $url . "'></script>";
			
		}
		private function GetScripts(){
			
			$ret = "";
			foreach($this->scripts AS $script){
				$ret.= $script;
			}
			return $ret;
		}
		public function GetXHTMLpage(){
			
		$output = "";
		$output .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'
		        .  '<html xmlns="http://www.w3.org/1999/xhtml">'
		    	.  '<head>'
		    	.  '<title>'
		    	.  $this->title 
		    	.  '</title>'
		   		.  '<meta http-equiv="content-type" content="text/html; charset=utf-8" />'
		   		.  "<link rel='stylesheet' href='" . $this->styleSheet. "' type='text/css' media='screen' title='no title' charset='".$this->charSet."'/>"
		        . $this->GetScripts()
		        .  '</head>'
		  		.  '<body class="">'
		  		. $this->menu
		  		. $this->leftSide
				. $this->content
				. $this->rightSide
				. $this->footer
		        . '</body>'
				. '</html>';
		return $output;
		
		}
	
 }
	
