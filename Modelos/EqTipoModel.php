<?php

class EqTipoModel extends ModelBase{

	public $pkEqTipo;
	public $codigo;
	public $descripcion;

	public function __construct(){
		parent::__construct();
		$this->tabla = 'speqtipo';
		$pkEqTipo = 0;
		$codigo = '';
		$descripcion = '';
	}

	public function guardarModel(){
		if($this->pkEqTipo <= 0){
			$this->addModel();
		}else{
			$this->editModel();
		}
	}
	private function addModel()
	{
		try {	
			//creamos un array con los parametros
			$parametros = $this->getParametros(0);
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
			$parametros = $this->getParametros(1);
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkEqTipo"] = $this->pkEqTipo;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":codigo"] = $this->codigo;
			
		if($tipo == 0) // insertar
			$parametros[":pkEqTipo"] = $this->pkEqTipo;

		return $parametros;
	}
	public function listar($where)
	{
		try{
			$consulta = "SELECT pkEqTipo, codigo, descripcion FROM " . $this->tabla;
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "Error en listar : " .$e->message;
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			
		}
	}
}
?>