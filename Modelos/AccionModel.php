<?php
class AccionModel extends ModelBase{

	public $pkAccion;
	public $codigo;
	public $descripcion;
	public $estado;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'accion';
		$pkAccion = 0;
		$codigo = '';
		$descripcion = "";
		$estado = "";
	}

	public function addModel()
	{
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			if($this->add($parametros))
				return true;
			else
				return false;

		} catch (PDOException $e) {
			echo "[AccionModel.addModel]" . $e->getMessage();
		}
	}
	public function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[AccionModel.editModel]" . $e->getMessage();
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkGrupo"] = $this->pkGrupo;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":estado"] = $this->estado;
		return $parametros;
	}
	public function listar()
	{
		try{			
			$consulta = "SELECT pkGrupo, codigo, descripcion, estado FROM " . $this->tabla;
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[AccionModel.listar]" . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[AccionModel.delModel]" . $e->getMessage();
		}
	}
}
?>