<?php
/**
* Clase Base de los controladores que contiene una vista
* donde se mostraran los datos generados por el controlador
*
**/
abstract class ControllerBase{

	private $view;

	function __construct(){
		$this->view = new View();
	}
	public function show($page, $data){
		$this->view->show($page, $data);
	}
}
?>