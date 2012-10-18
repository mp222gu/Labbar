<?php

namespace View;

class FormView{
	
	private $formArray = '';
	
	/**
	 * @return html
	 */
	public function BuildForm($method = "get", $action = "index.php", $enctype = ''){
		
		$output = '';
		$output .= '<form method=' . $method . ' action=' . $action   . ' enctype="' . $enctype .'">';
		
	    foreach($this->formArray as $f ){
	    	
			$output .= $f;
	    }
		$output .= '</form>';
		
		return $output;
	}
	
	
	public function BuildTextBox($name, $class = '', $value = ''){
		
		$this->formArray[] =  '<input type="text" name=' . $name . ' class="'. $class . '" value="'. $value . '"/>';
	}
	public function BuildTextBoxWithLabel($name,$class = '', $value = ''){
		
		$this->formArray[] =   $this->BuildLabel($name);
		$this->formArray[] =  '<input type="text" name=' . $name . ' class="'. $class . '" value="'. $value . '"/>';
	}
	public function BuildLabel($value, $class = ''){
		
		$this->formArray[] =  '<label class=' . $class .'>'. $value .'</label>';
	}
	public function BuildCheckBox($name, $class = '', $value = ''){
		
		$this->formArray[] = '<input type="checkbox" name="' . $name . '" class="'. $class . '" value="'. $value . '"/>';
	}
	public function BuildCheckBoxWithLabel( $name,  $class = '', $value = ''){
		
		$this->formArray[] =   $this->BuildLabel($name);
		$this->formArray[] = '<input type="checkbox" name="' . $name . '" class="'. $class . '" value="'. $value . '"/>';
	}
	public function BuildImage(  $src, $class = ''){
		
		$this->formArray[] = '<img  class='. $class . ' src='. $src . '/>';
	}
	public function BuildSubmitButton( $name, $value,  $class ='' ){
		
		$this->formArray[] =  '<input type="submit" name="' . $name . '" class="'. $class . '" value="'. $value . '"/>';
	}
	public function BuildControllerField($value){
		
		$this->formArray[] =  '<input type="hidden" name="controller" value="'. $value . '"/>';
	}
	public function BuildLink( $name,  $value,  $class=''){
		
		$this->formArray[] =  '<a href="'. $value. '" class="'.$class .'">'.$name . '</a>';
	}
	public function BuildHiddenField($name,$value){
		
		$this->formArray[] =  '<input type="hidden" name="'.$name.'" value="'. $value . '"/>';
	}
	public function BuildFileInput( $name){
		
		$this->formArray[] = '<input name="'.$name.'" type="file" />';
	}
	public function BuildInput($string){
		$this->formArray[] = $string;
	}
}
