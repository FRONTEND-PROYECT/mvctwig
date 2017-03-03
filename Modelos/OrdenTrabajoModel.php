<?php

class OrdenTrabajoModel extends ModelBase{
  
	public $pkOrdenTrabajo;
	public $codigo;
	public $fkGestion;
	public $nombre;
	public $supervisor;
	public $areaEstimada;
	public $estado;
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spordentrabajo';
		$pkOrdenTrabajo = 0;
		$codigo = '';
		$fkGestion = 0;
		$nombre = '';
		$supervisor = '';
		$areaEstimada = 0;
		$estado = '';
		$data = '';
	}

	public function guardarModel(){
		if($this->pkOrdenTrabajo <= 0){
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
			echo "Error Adicionar : " .$e->getMessage();
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "Error Editar : " .$e->getMessage();	
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkordentrabajo"] = $this->pkOrdenTrabajo;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
	
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fkgestion"] = $this->fkGestion;
		$parametros[":nombre"] = $this->nombre;
		$parametros[":supervisor"] = $this->supervisor;
		$parametros[":areaestimada"] = $this->areaEstimada;
		$parametros[":estado"] = $this->estado;
		$parametros[":data"] = $this->data;

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
			$consulta  = " SELECT o.pkordenTrabajo, o.codigo, o.fkGestion, o.nombre, o.supervisor, o.areaEstimada, o.estado, o.data, g.codigo as codgest ";
			$consulta .= " FROM spordentrabajo o INNER JOIN spgestion g ON o.fkGestion = g.pkGestion";

			//echo "consulta : $consulta";
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[OrdenTrabajoModel.listar]" .$e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);
		} catch (PDOException $e) {
			echo "[OrdenTrabajoModel.delModel] " . $e->getMessage();
		}
	}
	/**
	 * Metodo que devuelve una orden de trabajo a partir de la llave primaria
	 * @param  [Entero] $pkOrdenTrabajo Identificador primario de Orden de trabajo
	 * @return Array con los atributos de la tabla
	 */
	public function getOrdenTrabajo($pkOrdenTrabajo){
		try {
			$listado = $this->listar(" pkordenTrabajo = " . $pkOrdenTrabajo);

			if(count($listado)>0)
				return $listado[0];
			else
				return null;
		} catch (PDOException $e) {
			echo "[OrdenTrabajoModel.getOrdenTrabajo] " . $e->getMessage();
			return null;
		}
	}
	/**
	 * Metodo que devuelve una orden de trabajo a partir del data
	 * @param  [String] $data Es la concatenacion de codigo y gestion 004-14
	 * @return [Array] Devuelve un array con los atributos de la orden de trabajo
	 */
	public function getOrdenTrabajoFromData($data){
		try {
			$listado = $this->listar(" data = '" . $data . "' ");

			if(count($listado)>0)
				return $listado[0];
			else
				return null;
		} catch (PDOException $e) {
			echo "[OrdenTrabajoModel.getOrdenTrabajoFromData] " . $e->getMessage();
			return null;
		}
	}	
}
?>