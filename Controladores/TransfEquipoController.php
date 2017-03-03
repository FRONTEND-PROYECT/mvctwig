<?php
require_once "Modelos/OrdenTrabajoModel.php";
//require_once "Modelos/EquipoModel.php";
//require_once "Modelos/GestionModel.php";
//require_once "Modelos/TransfEquipoModel.php";
//require_once "Modelos/DetTransfEquipoModel.php";

class TransfEquipoController extends ControllerBase
{	  
	/*	
	private $personal = null;
	private $ot = null;
	private $transferencia = null;
	private $detTransferencia = null;
	private $gestion = null;
	*/
	public function __construct(){
		parent::__construct();

	/*	$this->personal = new PersonalModel();
		$this->ot = new OrdenTrabajoModel(); 
		$this->transferencia = new TransfPersonalModel();
		$this->detTransferencia= new DetTransfPersonalModel();
		$this->gestion = new GestionModel();*/
	}
	public function listar()
	{
		//$listado = $this->transferencia->listar("");
		
		$this->mostrar(null, null ,'error403.php');
		//$this->mostrar($listado, null ,'TransfPersonalListView.php');
	}/*
	public function editar(){
		$this->transferencia->pkTransfPersonal = $_POST['pkTransfPersonal'];

		# obtengo solo el encabezado
		$listado = $this->transferencia->getTransfPersonal($this->transferencia->pkTransfPersonal);
		
		#obtengo el detalle
		$detalles = $this->detTransferencia->getTodosDetTransfPersonal($this->transferencia->pkTransfPersonal);

		$this->mostrar($listado, $detalles, 'TransfPersonalView.php');
	}
	public function nuevo(){
		$listar = null;

		$this->obtenerGestionActiva();

		$this->mostrar($listar, null, 'TransfPersonalView.php');
	}

	public function guardar()
	{
		# encabezado
		$this->guardarEncabezado();

		$this->guardarDetalle($this->transferencia->pkTransfPersonal);

		$this->listar();
	}
	private function guardarEncabezado(){
		$this->transferencia->pkTransfPersonal 	= $_POST['pkTransfPersonal'];
		$this->transferencia->codigo 			= $_POST['codigo'];
		$this->transferencia->fkGestion 		= $_POST['fkGestion'];
		$this->transferencia->fecha 			= $_POST['fecha'];
		$this->transferencia->fkOrdenOrigen		= $_POST['fkOrdenOrigen'];
		$this->transferencia->fkOrdenDestino 	= $_POST['fkOrdenDestino'];
		$this->transferencia->observacion 		= $_POST['observacion'];

		$lista = $this->gestion->getGestion($_POST['fkGestion']);
		
		$this->transferencia->data 				= $_POST['codigo'] . '-' . $lista['codigo'];
		$this->transferencia->estado			= "T";

		$this->transferencia->guardarModel();

	}
	private function obtenerGestionActiva(){
		$lista = $this->gestion->listar(" estado = 'T' ");
		$lista = $lista->fetchAll();

		$_SESSION['pkGestion'] = $lista[0]['pkGestion'];
		$_SESSION['codgest'] = $lista[0]['codigo'];
	}

	private function guardarDetalle($pkTransf){
		 $detalles = json_decode($_POST['detalle']);

		 $pk = $this->transferencia->lastPrimaryKey();

		 foreach ($detalles as $detalle){
		 	if(strlen ($detalle[2]) > 0 ){
		 		$this->detTransferencia->pkDetTransfPersonal 	= $detalle[0];#pkDetTransfPersonal;

		 		# Es la llave de Transferencia
		 		if($pkTransf <= 0){ # quiere decir que es nuevo detalle
		 			$this->detTransferencia->fkTransfPersonal 	= $pk;#->fkTransfPersonal;
		 		}else{# esta solo editando
		 			$this->detTransferencia->fkTransfPersonal 	= $detalle[1];#->fkTransfPersonal;	
		 		}
			 	$this->detTransferencia->item 					= $detalle[2];#->item;
			 	$this->detTransferencia->fkPersonal 			= $detalle[3];#->fkPersonal;
			 	$this->detTransferencia->observacion 			= $detalle[4];#->observacion;
			 	$this->detTransferencia->guardarModel();
		 	}
		}
	}
	public function eliminar()
	{
		$this->transferencia->pkTransfPersonal = $_POST['pkTransfPersonal'];
		$this->transferencia->delModel();

		$this->listar();
	}
	public function getOrdenTrabajo(){
		$this->ot->data = $_POST['data'];
		$listado = $this->ot->listar(" data = '" . $this->ot->data . "' ");
		$array   = $listado->fetchAll();

		
		if(count($array) > 0){
			$array[0]['status'] = "success";
			echo json_encode($array[0]);
		}else{
			$array[0]['status'] = "error";
			echo json_encode($array[0]);
		}
	}

	public function getPersonal(){
		$this->personal->data = $_POST['data'];
		$listado = $this->personal->listar(" pkPersonal = '" . $this->personal->data . "' ");
		$array   = $listado->fetchAll();

		
		if(count($array) > 0){
			$array[0]['status'] = "success";
			echo json_encode($array[0]);
		}else{
			$array[0]['status'] = "error";
			echo json_encode($array[0]);
		}
	}
*/
	# metodos privados
	private function mostrar($listado, $detalles, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$data['detalles'] = $detalles;
		
		$this->show($vista, $data);
	}
}
?>