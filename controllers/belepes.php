<?php
spl_autoload_register('yourAutoloadFunction');

class Belepes_Controller
{
	public $baseName = 'belepes'; 
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}
?>