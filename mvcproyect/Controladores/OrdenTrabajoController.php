<?php
require_once "Modelos/OrdenTrabajoModel.php";
require_once "Modelos/GestionModel.php";

class OrdenTrabajoController extends ControllerBase
{
	private $ot = null;
	private $gestion = null;

	public function __construct(){
		parent::__construct();
		$this->ot = new OrdenTrabajoModel();
		$this->gestion = new GestionModel();

		$this->obtenerGestionActiva();

	}
	public function listar()
	{
		$listado = $this->ot->listar("");
	
		$this->mostrar($listado, 'OrdenTrabajoListView.php');
	}
	public function editar(){
		$this->ot->pkOrdenTrabajo = $_POST['pkOrdenTrabajo'];
		$ot = $this->ot->getOrdenTrabajo($this->ot->pkOrdenTrabajo);
	
		$this->mostrar($ot, 'OrdenTrabajoView.php');
	}
	public function nuevo(){
		$listar = null;
		$this->mostrar($listar, 'OrdenTrabajoView.php');
	}
	private function obtenerGestionActiva(){

		$lista = $this->gestion->listar(" estado = 'T' ");
		
		if(count($lista) > 0){
			$_SESSION['pkGestion'] = $lista[0]->pkgestion;
			$_SESSION['codgest'] = $lista[0]->codigo;
		}else{
			$_SESSION['pkGestion'] = -1;
			$_SESSION['codgest'] = "";
		}
	}
	public function guardar()
	{

		$this->ot->pkOrdenTrabajo = $_POST['pkOrdenTrabajo'];
		$this->ot->codigo = $_POST['codigo'];
		$this->ot->fkGestion = $_POST['fkGestion'];
		$this->ot->nombre = $_POST['nombre'];
		$this->ot->supervisor = $_POST['supervisor'];
		$this->ot->areaEstimada = $_POST['areaEstimada'];
		$this->ot->estado = $_POST['estado'];
		$this->ot->data = $_POST['data'];
		
		$this->ot->guardarModel();

		$this->listar();
	}
	public function eliminar()
	{
		$this->ot->pkOrdenTrabajo = $_POST['pkOrdenTrabajo'];
		$this->ot->delModel();

		$this->listar();
	}

	# metodos privados
	private function mostrar($listado, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$this->show($vista, $data);
	}
	private function toString($listado){
		while ($data = $listado->fetch()) {
			echo 'id : ' . $data['pkOrdenTrabajo'];
			echo 'codigo : ' . $data['codigo'];
			echo 'nombre : ' . $data['nombre'];
			echo 'data : ' . $data['data'];
		}
	}
}
?>
