<?php

class ActividadModel extends ModelBase{

	public $pkActividad;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spactividad';
		$pkActividad = 0;
		$codigo = '';
		$descripcion = '';
	}
	
	public function guardarModel(){
		if($this->pkActividad <= 0){
			$this->addModel();
		}else{
			$this->editModel();
		}
	}

	private function addModel(){
		try {	
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			if($this->add($parametros))
				return true;
			else
				return false;

		} catch (PDOException $e) {
			echo "Error Adicionar : " .$e->message;
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkActividad"] = $this->pkActividad;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;

		return $parametros;
	}
	/**
	 * Devuelve un array de objetos los atributos son las columnas de la tablas
	 * @param  [String] $where Condicion de la consulta
	 * @return Array de objetos con atributo se puede acceder[$modelo->nombreColumna]
	*/	
	public function listar($where)
	{
		try{
			$consulta = "SELECT pkActividad, codigo, descripcion FROM " . $this->tabla;
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[ActividadModel.listar]" . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[ActividadModel.delModel]" . $e->getMessage();
		}
	}
}
?>