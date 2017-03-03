<?php
require_once "Modelos/ImproductivaModel.php";

class ImproductivaController extends ControllerBase
{
	private $improductiva = null;

	public function __construct(){
		parent::__construct();
		$this->improductiva = new ImproductivaModel();
	}
	public function listar()
	{
		$listado = $this->improductiva->listar("");
		$this->mostrar($listado, 'ImproductivaListView.php');
	}
	public function editar(){

		$this->improductiva->pkImproductiva = $_POST['pkImproductiva'];

		$imp = $this->improductiva->getImproductiva($this->improductiva->pkImproductiva);
		$this->mostrar($imp, 'ImproductivaView.php');
	}
	public function nuevo(){
		$listar = null;

		$this->mostrar($listar, 'ImproductivaView.php');
	}
	public function guardar()
	{
		$this->improductiva->pkImproductiva = $_POST['pkImproductiva'];
		$this->improductiva->codigo = $_POST['codigo'];
		$this->improductiva->descripcion = $_POST['descripcion'];

		$this->improductiva->guardarModel();
		$this->listar();
	}
	public function eliminar()
	{
		$this->improductiva->pkImproductiva = $_POST['pkImproductiva'];
		$this->improductiva->delModel();

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
			echo 'id : ' . $data['pkImproductiva'];
			echo 'codigo : ' . $data['codigo'];
			echo 'descri : ' . $data['descripcion'];
		}
	}
}

?>