<?php

spl_autoload_register('yourAutoloadFunction');

class Felveteli_Controller
{
	public $baseName = 'felveteli'; 
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}

?>