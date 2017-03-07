<?php
require_once "Modelos/GestionModel.php";

class GestionController extends ControllerBase
{
	private $gestion = null;

	public function __construct(){
		parent::__construct();

		$this->gestion = new GestionModel();
	}
	public function listar()
	{
		$gestiones = $this->gestion->listar("");
		
		$this->mostrar($gestiones, 'GestionListView.php');
	}
	public function editar(){

		$this->gestion->pkGestion = $_POST['pkGestion'];
		$g = $this->gestion->getGestion($this->gestion->pkGestion);		
		$this->mostrar($g, 'GestionView.php');
	}
	public function nuevo(){
		$listar = null;

		$this->mostrar($listar, 'GestionView.php');
	}

	public function guardar()
	{
		$this->gestion->pkGestion 		= $_POST['pkGestion'];
		$this->gestion->codigo 			= $_POST['codigo'];
		$this->gestion->fechaIni 		= $_POST['fechaIni'];
		$this->gestion->fechaFin 		= $_POST['fechaFin'];
		$this->gestion->estado			= $_POST['estado'];

		$this->gestion->guardarModel();

		$this->listar();
	}
	public function eliminar()
	{
		$this->gestion->pkGestion = $_POST['pkGestion'];
		$this->gestion->delModel();

		$this->listar();
	}
	/**
	 * Metodo que muestra la plantilla para mostrar al usuario
	 * @param  [variables] $listado Son las variables que se pasaran a la vista
	 * @param  [String] $vista   Es el nombre de la plantilla	 
	 */
	private function mostrar($listado, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$this->show($vista, $data);
	}
}
?>