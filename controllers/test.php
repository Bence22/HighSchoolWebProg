<?php


class Test_Controller
{
	public $baseName = 'test'; 
	public function main(array $vars) 
	{
		$testModel = new Test_Model;  
		
		if(! isset($vars[0])) $vars[0] = "";
		$reqData = $testModel->get_data($vars[0]); 
	
		$view = new View_Loader($this->baseName.'_main');
		
		$view->assign('title', $reqData['title']);
		$view->assign('content', $reqData['content']);
	}
}

?>