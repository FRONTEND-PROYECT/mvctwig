<?php

class TransfEquipoModel extends ModelBase{

	public $pkTransfEquipo;
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
		$pkTransfEquipo = 0;
		$codigo = "";
		$fkGestion = 0;
		$fecha = '1990-01-01';
		$fkOrdenOrigen = 0;
		$fkOrdenDestino = 0;
		$observacion = '';
		$data = '';
		$estado = '';
	}
	public function guardarModel(){
		if($this->pkTransfEquipo <= 0){
			$this->addModel();
		}else{
			$this->editModel();
		}
	}
	# devuelve la ultima llave primaria de la transferencia
	public function lastPrimaryKey(){
		return $this->LlavePrimaria;
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
			$parametros[":pkTransfEquipo"] = $this->pkTransfEquipo;
			return $parametros;
	}
	private function getParametros($tipo){		
		$parametros = array();			
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fkGestion"] = $this->fkGestion;
		$parametros[":fecha"] = $this->fecha;
		$parametros[":fkOrdenOrigen"] = $this->fkOrdenOrigen;
		$parametros[":fkOrdenDestino"] = $this->fkOrdenDestino;
		$parametros[":observacion"] = $this->observacion;
		$parametros[":data"] = $this->data;
		$parametros[":estado"] = $this->estado;
		
		if($tipo == 0) // insertar
			$parametros[":pkTransfPersonal"] = $this->pkTransfPersonal;

		return $parametros;
	}
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

	# devuelve una orden de trabajo
	public function getTransfPersonal($pkTransfPersonal){
		try {
			$listado = $this->listar(" pkTransfPersonal = " . $pkTransfPersonal);
			$listados = $listado->fetchAll();
			if(count($listados)>0)
				return $listados[0];
			else
				return null;
		} catch (PDOException $e) {
			echo 'error : io';
			return null;
		}
	}

}
?>