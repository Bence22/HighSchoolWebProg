<?php
spl_autoload_register('yourAutoloadFunction');

class Kilepes_Controller
{
	public $baseName = 'kilepes'; 
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}
?>