<?php

class TransfPersonalModel extends ModelBase{

	public $pkTransfPersonal;
	public $codigo;
	public $fkGestion;
	public $fecha;
	public $fkOrdenOrigen;
	public $fkOrdenDestino;
	public $observacion;
	public $data;
	public $estado;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'sptransfpersonal';
		$pkTransfPersonal = 0;
		$codigo = "";
		$fkGestion = 0;
		$fecha = '1990-01-01';
		$fkOrdenOrigen = 0;
		$fkOrdenDestino = 0;
		$observacion = '';
		$data = '';
		$estado = '';
		$this->sequencia = "sptransfpersonal_pktransfpersonal_seq";
	}
	public function guardarModel(){
		if($this->pkTransfPersonal <= 0){
			$this->addModel();
		}else{
			$this->editModel();
		}
	}
	/**
	 * Devuelve la ultima llave primaria de la transferencia de personal
	 * @return [entero] La ultima llave primaria
	 */
	public function lastPrimaryKey(){
		return $this->LlavePrimaria;
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
			echo "[TransfPersonalModel.addModel] " . $e->getMessage();
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			return $this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[TransfPersonalModel.editModel]" . $e->getMessage();
			return;
		}
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pktransfpersonal"] = $this->pkTransfPersonal;
			return $parametros;
	}
	private function getParametros(){
		$parametros = array();			
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fkgestion"] = $this->fkGestion;
		$parametros[":fecha"] = $this->fecha;
		$parametros[":fkordenorigen"] = $this->fkOrdenOrigen;
		$parametros[":fkordendestino"] = $this->fkOrdenDestino;
		$parametros[":observacion"] = $this->observacion;
		$parametros[":data"] = $this->data;
		$parametros[":estado"] = $this->estado;
		
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
			$consulta .= " t.pkTransfPersonal, t.codigo, t.fkGestion, t.fecha, ";
			$consulta .= " t.fkOrdenOrigen, t.fkOrdenDestino, t.observacion, t.data, ";
			$consulta .= " t.estado, w.data as codOtOrigen, w.nombre as nombreOrigen, ";
			$consulta .= " q.data as codOtDestino, q.nombre as nombreDestino ";
			
			$consulta .= " FROM sptransfpersonal t ";
			$consulta .= " 	INNER JOIN spOrdenTrabajo w ON t.fkOrdenOrigen  = w.pkOrdenTrabajo ";
			$consulta .= " 	INNER JOIN spOrdenTrabajo q ON t.fkOrdenDestino = q.pkOrdenTrabajo ";

			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			$filas  = $this->consultar($consulta);

			# debo realizar los cambios de la fecha
			foreach ($filas as $value) {
				$value->fecha = FuncionesComunes::cambiarFormato($value->fecha);
			}

			return $filas;
		}catch(PDOException $e){
			echo "[TransfPersonalModel.listar]" . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[TransfPersonalModel.delModel]" . $e->getMessage();
		}
	}

	/**
	 * Metodo que devuelve una transferencia de personal a partir de la llave primaria
	 * @param  [Entero] $pkTransfPersonal Identificador primaria de la transferencia
	 * @return [Array] Devuelve un array con los atributos de la tabla.
	 */
	public function getTransfPersonal($pkTransfPersonal){
		try {
			$listado = $this->listar(" pkTransfPersonal = " . $pkTransfPersonal);
			
			if(count($listado)>0)
				return $listado[0];
			else
				return null;
		} catch (PDOException $e) {
			echo '[TransfPersonalModel.getTransfPersonal] ' . $e->getMessage();
			return null;
		}
	}
	public function deleteLogico($pkTransfPersonal){
		try {
			$listado = $this->getTransfPersonal($pkTransfPersonal);
			if(!is_null($listado)){ // no es nulo
 				$this->pkTransfPersonal = $listado->pktransfpersonal;
				$this->codigo = $listado->codigo;
				$this->fkGestion = $listado->fkgestion;
				$this->fecha = $listado->fecha;
				$this->fkOrdenOrigen = $listado->fkordenorigen;
				$this->fkOrdenDestino = $listado->fkordendestino;
				$this->observacion = $listado->observacion;
				$this->data = $listado->data;
				$this->estado = "F";
				$this->editModel();				
			}
		} catch (Exception $e) {
			echo "[TransfPersonalModel.deleteLogico]" . $e->getMessage();
		}
	}
}
?>