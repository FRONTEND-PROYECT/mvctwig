<?php

class EqModeloModel extends ModelBase{

	public $pkEqModelo;
	public $fkEqTipo;
	public $codigo;
	public $descripcion;

	public function __construct(){
		parent::__construct();
		$this->tabla = 'speqmodelo';
		$pkEqModelo = 0;
		$fkEqTipo = 0;
		$codigo = '';
		$descripcion = '';
	}

	public function guardarModel(){
		if($this->pkEqModelo <= 0){
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
			echo "Error Adicionar : " .$e->getMessage();
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros(1);
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo 'Error al editar : ' . $e->getMessage();
		}
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkEqModelo"] = $this->pkEqModelo;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();
		$parametros[":fkEqTipo"] = $this->fkEqTipo;
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":codigo"] = $this->codigo;
			
		if($tipo == 0) // insertar
			$parametros[":pkEqModelo"] = $this->pkEqModelo;

		return $parametros;
	}
	public function listar($where)
	{
		try{
			$consulta = "SELECT pkEqModelo, fkEqTipo, codigo, descripcion FROM " . $this->tabla;
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "Error en listar : " .$e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "Error en eliminar : " .$e->getMessage();	
		}
	}
}
?>