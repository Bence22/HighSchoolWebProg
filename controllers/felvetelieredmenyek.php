<?php

class Felvetelieredmenyek_Controller
{
	public $baseName = 'felvetelieredmenyek';  
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}

?>