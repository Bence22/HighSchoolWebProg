<?php

class Eredmenyek_Controller
{
	public $baseName = 'eredmenyek'; 
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}

?>