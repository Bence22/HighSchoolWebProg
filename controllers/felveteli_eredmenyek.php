<?php

spl_autoload_register('yourAutoloadFunction');

class Felveteli_Eredmenyek_Controller
{
	public $baseName = 'felveteli_eredmenyek';  
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}

?>
