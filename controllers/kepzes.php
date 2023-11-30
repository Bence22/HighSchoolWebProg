<?php
spl_autoload_register('yourAutoloadFunction');

class Kepzes_Controller
{
    public $baseName = 'kepzes';  

    public function main(array $vars) 
    {
        
        $view = new View_Loader($this->baseName."_main");
    }
}