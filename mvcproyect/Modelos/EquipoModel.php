<?php
require_once "Negocio/FuncionesComunes.php";

class EquipoModel extends ModelBase{

	public $pkEquipo;
	public $fkTipoEquipo;
	public $fkModelo;
	public $codigo;
	public $fkTipoContrato;
	public $fechaIngreso;
	public $fkOrdenTrabajo;
	public $descripcion;


	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spequipo';
		$pkEquipo = 0;
		$fkTipoEquipo = 0;
		$fkModelo = 0;
		$codigo = '';
		$fkTipoContrato = 0;
		$fechaIngreso = '1990-01-01';
		$fkOrdenTrabajo = 0;
		$descripcion = '';
	}
	public function guardarModel(){
		if($this->pkEquipo <= 0){
			$this->addModel();
		}else{
			$this->editModel();
		}
	}

	private function addModel()
	{
		try {	
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			if($this->add($parametros))
				return true;
			else
				return false;
		} catch (PDOException $e) {
			echo "[EquipoModel.addModel]" .$e->getMessage();
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
			$parametros[":pkequipo"] = $this->pkEquipo;
			return $parametros;
	}
	private function getParametros(){
		$parametros = array();			
		$parametros[":fktipoequipo"] = $this->fkTipoEquipo;
		$parametros[":fkmodelo"] = $this->fkModelo;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fktipocontrato"] = $this->fkTipoContrato;
		$parametros[":fechaingreso"] = $this->fechaIngreso;
		$parametros[":fkordentrabajo"] = $this->fkOrdenTrabajo;
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
			$consulta = " SELECT ";
			$consulta .= " e.pkEquipo, e.fkTipoEquipo, e.fkModelo, e.codigo,  ";
			$consulta .= " e.fkTipoContrato, e.fechaIngreso, e.fkOrdenTrabajo, ";
			$consulta .= " e.descripcion, o.data, o.nombre ";
			$consulta .= " FROM spequipo e ";
			$consulta .= " 	INNER JOIN speqtipo t ON e.fkTipoEquipo = t.pkEqTipo ";
			$consulta .= " 	INNER JOIN speqmodelo m ON e.fkModelo = m.pkEqModelo ";
			$consulta .= " 	INNER JOIN spordentrabajo o ON e.fkOrdenTrabajo = o.pkOrdenTrabajo ";

			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			
			$filas = $this->consultar($consulta);
			# debo realizar los cambios de la fecha
			foreach ($filas as $value) {

				$value->fechaingreso = FuncionesComunes::cambiarFormato($value->fechaingreso);
			}
			return $filas;
		}catch(PDOException $e){
			echo "[EquipoModel.listar]" .$e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[EquipoModel.delModel] " . $e->getMessage();
		}
	}

	/**
	 * Metodo que devuelve un Equipo a partir de la llave primaria
	 * @param  [Entero] $pkEquipo Identificador primario de Equipo
	 * @return Array con los atributos de la tabla
	 */
	public function getEquipo($pkEquipo){
		try {
			$listado = $this->listar(" pkEquipo = " . $pkEquipo);
			
			if(count($listado)>0)
				return $listado[0];
			else
				return null;
		} catch (PDOException $e) {
			echo '[EquipoModel.getEquipo]' . $e->getMessage();
			return null;
		}
	}
}
?>