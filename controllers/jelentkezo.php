<?php

spl_autoload_register('yourAutoloadFunction');

class Jelentkezo_Controller
{
    public $baseName = 'kliens';  

    public function main(array $vars) 
    {
        
        $view = new View_Loader($this->baseName."_main");
    }
}
?>