<?php

class ItemObraModel extends ModelBase{

	public $pkItemObra;
	public $fkOrdenTrabajo;
	public $fkPoligono;
	public $fkActividad;
	public $codigo;
	public $descripcion;
	public $areaTrab;
	public $rendimiento;

	public function __construct()
	{
		parent::__construct();
		$this->tabla 	= 'spitemobra';		
		$pkItemObra 	= 0;
		$fkOrdenTrabajo = 0;
		$fkPoligono 	= 0;
		$fkActividad 	= 0;
		$codigo 		= '';
		$descripcion 	= '';
		$areaTrab 		= 0;
		$rendimiento 	= 0;
	}
	public function guardarModel(){
		if($this->pkItemObra <= 0){
			$this->addModel();
		}else{
			$this->editModel();
		}
	}
	private function addModel()
	{
		try{	
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			if($this->add($parametros))
				return true;
			else
				return false;

		} catch (PDOException $e) {
			echo "[ItemObraModel.addModel] " .$e->getMessage();
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[ItemObraModel.editModel]" .$e->getMessage();	
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkitemobra"] = $this->pkItemObra;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();	
		$parametros[":fkordentrabajo"] = $this->fkOrdenTrabajo;
		$parametros[":fkpoligono"] = $this->fkPoligono;
		$parametros[":fkactividad"] = $this->fkActividad;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":areatrab"] = $this->areaTrab;
		$parametros[":rendimiento"] = $this->rendimiento;

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
			$consulta  = " SELECT ";
			$consulta .= " o.pkItemObra, o.fkOrdenTrabajo, o.fkPoligono, o.fkActividad, ";
			$consulta .= " o.codigo, o.descripcion, o.areaTrab, o.rendimiento, i.nombre, i.data ";
			$consulta .= " FROM spitemobra o ";
			$consulta .= " INNER JOIN spordentrabajo i ON o.fkOrdenTrabajo = i.pkOrdenTrabajo ";

			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[ItemObraModel.listar]" .$e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);
		} catch (PDOException $e) {
			echo "[ItemObraModel.delModel]" . $e->message();
		}
	}
	/**
	 * Metodo que devuelve un itemObra a partir de la llave primaria
	 * @param  [Entero] $pkItemObra Llave primaria
	 * @return [ItemObra]  Devuelve un array de con los item obras 
	 */	
	public function getItemObra($pkItemObra){
		try {
			$listado = $this->listar(" pkitemobra = " . $pkItemObra);
			
			if(count($listado)>0)
				return $listado[0];
			else
				return null;
		} catch (PDOException $e) {
			echo '[ItemObraModel.getItemObra]'.$e->getMessage();
			return null;
		}
	}
}
?>