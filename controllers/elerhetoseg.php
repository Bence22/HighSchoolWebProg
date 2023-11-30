<?php

spl_autoload_register('yourAutoloadFunction');

class Elerhetoseg_Controller
{
	public $baseName = 'elerhetoseg'; 
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}

?>