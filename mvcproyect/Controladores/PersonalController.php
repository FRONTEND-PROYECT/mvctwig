<?php
require_once "Modelos/PersonalModel.php";
require_once "Modelos/OrdenTrabajoModel.php";
require_once "Modelos/CargoModel.php";
/**
 * Clase controladora encargada de las acciones del personal
 */

class PersonalController extends ControllerBase
{
	private $personal = null;
	private $orden = null;
	private $cargo = null;

	public function __construct(){
		parent::__construct();

		$this->orden = new OrdenTrabajoModel();
		$this->cargo = new CargoModel(); 
		$this->personal = new PersonalModel();
	}
	public function listar()
	{
		try {
			$listado = $this->personal->listar("");
		
			$this->mostrar($listado, null, 'PersonalListView.php');
		} catch (Exception $e) {
			echo "[PersonalController.listar] " . $e->getMessage();
		}
	}

	public function editar(){
		
		$this->personal->pkPersonal = $_POST['pkPersonal'];

		$persona = $this->personal->getPersonal($this->personal->pkPersonal);
		
		#ademas enviamos la lista de cargos
		$cargos = $this->cargo->listar("");

		$this->mostrar($persona, $cargos, 'PersonalView.php');
	}

	public function nuevo(){
		$listar = null;

		#ademas enviamos la lista de cargos
		$cargos = $this->cargo->listar("");

		$this->mostrar($listar, $cargos, 'PersonalView.php');
	}

	public function guardar()
	{
		$this->personal->pkPersonal 	= $_POST['pkPersonal'];
		$this->personal->fechaIngreso 	= $_POST['fechaIngreso'];
		$this->personal->nombreComp 	= $_POST['nombreComp'];
		$this->personal->apellidos 		= $_POST['apellidos'];
		$this->personal->direccion		= $_POST['direccion'];
		$this->personal->telefono 		= $_POST['telefono'];
		$this->personal->ci 			= $_POST['ci'];
		$this->personal->fechaNac 		= $_POST['fechaNac'];
		$this->personal->fkCargo 		= $_POST['fkCargo'];
		$this->personal->fkOrdenTrabajo = $_POST['fkOrdenTrabajo'];
		$this->personal->email 			= $_POST['email'];

		$this->personal->guardarModel();

		$this->listar();
	}
	public function eliminar()
	{
		$this->personal->pkPersonal = $_POST['pkPersonal'];
		$this->personal->delModel();

		$this->listar();
	}
	public function getOrdenTrabajo(){
		$data = $_POST['data'];
		$listado = $this->orden->getOrdenTrabajoFromData($data);
		
		if(count($listado) > 0){
			$listado->status = "success";
			echo json_encode($listado);
		}else{
			$listado = array();
			$listado["status"] = "error";
			echo json_encode($listado);
		}
	}
	# metodos privados
	private function mostrar($listado, $cargos, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$data['cargos'] = $cargos;
		$this->show($vista, $data);
	}
}
?>