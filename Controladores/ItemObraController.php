<?php
require_once "Modelos/OrdenTrabajoModel.php";
require_once "Modelos/PoligonoModel.php";
require_once "Modelos/ActividadModel.php";
require_once "Modelos/ItemObraModel.php";

class ItemObraController extends ControllerBase
{
	private $itemObra = null;
	private $ot = null;
	private $poligono = null;
	private $actividad = null;

	public function __construct(){
		parent::__construct();

		$this->itemObra = new ItemObraModel();
		$this->ot = new OrdenTrabajoModel(); 
		$this->poligono = new PoligonoModel();
		$this->actividad = new ActividadModel();
	}
	public function listar()
	{
		$listado = $this->itemObra->listar("");
	
		$this->mostrar($listado, null, null, 'ItemObraListView.php');
	}
	public function editar(){

		$this->itemObra->pkItemObra = $_POST['pkItemObra'];

		$io = $this->itemObra->getItemObra($this->itemObra->pkItemObra);
		
		#ademas enviamos la lista de poligonos
		$poligonos = $this
						->poligono
						->listar(" fkordentrabajo = " . $io->fkordentrabajo);

		#ademas enviamos la lista de actividades
		$actividades = $this
						->actividad
						->listar(" fkordentrabajo = " . $io->fkordentrabajo);

		$this->mostrar($io, $poligonos, $actividades, 'ItemObraView.php');
	}
	public function nuevo(){
		$listar = null;

		#ademas enviamos la lista de poligonos
		# modificar despues las ot
		#$poligonos = $this->poligono->listar("");
		$poligonos = null;
		#ademas enviamos la lista de actividades
		#$actividades = $this->actividad->listar("");
		$actividades = null;

		$this->mostrar($listar, $poligonos, $actividades, 'ItemObraView.php');
	}

	public function guardar()
	{
		$this->itemObra->pkItemObra 	= $_POST['pkItemObra'];
		$this->itemObra->fkOrdenTrabajo = $_POST['fkOrdenTrabajo'];
		$this->itemObra->fkPoligono 	= $_POST['fkPoligono'];
		$this->itemObra->fkActividad 	= $_POST['fkActividad'];
		$this->itemObra->codigo			= $_POST['codigo'];
		$this->itemObra->descripcion 	= $_POST['descripcion'];
		$this->itemObra->areaTrab 		= $_POST['areaTrab'];
		$this->itemObra->rendimiento 	= $_POST['rendimiento'];

		$this->itemObra->guardarModel();

		$this->listar();
	}
	public function eliminar()
	{
		$this->itemObra->pkItemObra = $_POST['pkItemObra'];
		$this->itemObra->delModel();

		$this->listar();
	}
	/**
	 * Metodo que verifica la orden de trabajo
	 * @return [ot] Devuelve una orden de trabajo
	 */
	public function getOrdenTrabajo(){
		$data = $_POST['data'];
		$listado = $this->ot->getOrdenTrabajoFromData($data);
		
		if(count($listado) > 0){
			$listado->status = "success";
			# obtenemos la lista de poligonos
				$poligonos = $this
							->poligono
							->listar(" fkordentrabajo = " . 
										$listado->pkordentrabajo);
			# obtenemos la lista de actividades
				$actividades = $this
							->actividad
							->listar(" fkordentrabajo = " . 
										$listado->pkordentrabajo);

			$listado->poligonos = $poligonos;
			$listado->actividades = $actividades;
			
			echo json_encode($listado);
		}else{
			$listado = array();
			$listado["status"] = "error";
			$listado["poligonos"] = null;
			$listado["actividades"] = null;
			echo json_encode($listado);			
		}
	}
	# metodos privados
	private function mostrar($ios, $poligonos, $actividades, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['ios'] = $ios;
		$data['poligonos'] = $poligonos;
		$data['actividades'] = $actividades;
		$this->show($vista, $data);
	}
}
?>