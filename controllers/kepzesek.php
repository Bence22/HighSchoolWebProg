<?php
spl_autoload_register('yourAutoloadFunction');

class Kepzesek_Controller
{
    public $baseName = 'kepzesek';  
    public function main(array $vars) 
    {
        
        $view = new View_Loader($this->baseName."_main");
    }
}