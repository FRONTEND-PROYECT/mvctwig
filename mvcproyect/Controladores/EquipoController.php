<?php
require_once "Modelos/OrdenTrabajoModel.php";
require_once "Modelos/EqModeloModel.php";
require_once "Modelos/EqTipoModel.php";
require_once "Modelos/EquipoModel.php";

class EquipoController extends ControllerBase
{
	private $eqModel = null;
	private $ot = null;
	private $eqTipo = null;
	private $equipo = null;

	public function __construct(){
		parent::__construct();

		$this->eqModel = new EqModeloModel();
		$this->ot = new OrdenTrabajoModel(); 
		$this->eqTipo = new EqTipoModel();
		$this->equipo = new EquipoModel();
	}
	public function listar()
	{
		$listado = $this->equipo->listar("");
	
		$this->mostrar($listado, null, null, 'EquipoListView.php');
	}
	public function editar(){
		$this->equipo->pkEquipo = $_POST['pkEquipo'];

		$eq = $this->equipo->getEquipo($this->equipo->pkEquipo);
		
		#ademas enviamos la lista de tipos de equipos
		$tipos = $this->eqTipo->listar("");

		#ademas enviamos los modelos de equipos
		$modelos = $this->eqModel->listar(" fkeqtipo = " . $eq->fktipoequipo);

		$this->mostrar($eq, $tipos, $modelos, 'EquipoView.php');
	}
	public function nuevo(){
		$listar = null;

		#Solo enviamos los tipos de equipos
		$tipos = $this->eqTipo->listar("");

		#los modelos seran a peticion del tipo de equipo

		$this->mostrar($listar, $tipos, null, 'EquipoView.php');
	}

	public function guardar()
	{
		$this->equipo->pkEquipo 		= $_POST['pkEquipo'];
		$this->equipo->fkTipoEquipo 	= $_POST['fkTipoEquipo'];
		$this->equipo->fkModelo 		= $_POST['fkModelo'];
		$this->equipo->codigo 			= $_POST['codigo'];
		$this->equipo->fkTipoContrato	= $_POST['fkTipoContrato'];
		$this->equipo->fechaIngreso 	= $_POST['fechaIngreso'];
		$this->equipo->fkOrdenTrabajo 	= $_POST['fkOrdenTrabajo'];
		$this->equipo->descripcion 		= $_POST['descripcion'];
		
		$this->equipo->guardarModel();

		$this->listar();
	}
	public function eliminar()
	{
		$this->equipo->pkEquipo = $_POST['pkEquipo'];
		$this->equipo->delModel();

		$this->listar();
	}
	public function getOrdenTrabajo(){
		$this->ot->data = $_POST['data'];
		$orden = $this->ot->getOrdenTrabajoFromData($this->ot->data);

		if(count($orden) > 0){
			$orden->status = "success";

			echo json_encode($orden);
		}else{
			$orden = array();
			$orden['status'] = "error";
			
			echo json_encode($orden);
		}
	}
	/**
	 * Metodo que lista los modelos de un tipo de equipo
	 */
	public function getModelos(){
		$this->eqModel->fkEqTipo = $_POST['tipo'];
		#echo "tipo llego : " . $this->eqModel->fkEqTipo;
		$modelos = $this
						->eqModel
						->listar(" fkeqtipo = " . $this->eqModel->fkEqTipo);


		if(count($modelos) > 0){
			$rs = array();
			$rs["modelos"] = $modelos;
			$rs["status"] = "success";
			echo json_encode($rs);
		}else{
			$rs = array();
			$rs['status'] = "error";
			echo json_encode($rs);
		}
	}
	# metodos privados
	private function mostrar($listado, $tipos, $modelos, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$data['tipos'] = $tipos;
		$data['modelos'] = $modelos;
		$this->show($vista, $data);
	}
}
?>