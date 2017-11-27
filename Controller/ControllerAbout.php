<?php

require_once 'View/View.php';

class ControllerAbout{
	public function about(){
		$view =new View ("About");
		$view->create(array());
	}
}