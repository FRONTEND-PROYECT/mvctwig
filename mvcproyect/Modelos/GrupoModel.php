<?php
class GrupoModel extends ModelBase{

	public $pkGrupo;
	public $descripcion;
	public $estado;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'grupo';
		$pkGrupo = 0;
		$descripcion = '';
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
			echo "[GrupoModel.addModel]" . $e->getMessage();
		}
	}
	public function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[GrupoModel.editModel]" . $e->getMessage();
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkGrupo"] = $this->pkGrupo;
			return $parametros;
	}
	private function getParametros(){		
		$parametros = array();			
		$parametros[":descripcion"] = $this->descripcion;	
		$parametros[":estado"] = $this->estado;
		return $parametros;
	}
	public function listar()
	{
		try{			
			$consulta = "SELECT pkGrupo, descripcion, estado FROM " . $this->tabla;
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[GrupoModel.listar]" . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[GrupoModel.delModel]" . $e->getMessage();
		}
	}
}
?>