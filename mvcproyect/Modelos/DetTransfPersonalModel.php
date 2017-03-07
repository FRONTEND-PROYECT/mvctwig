<?php

class DetTransfPersonalModel extends ModelBase{

	public $pkDetTransfPersonal;
	public $fkTransfPersonal;
	public $item;
	public $fkPersonal;
	public $observacion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spdettransfpersonal';
		$pkDetTransfPersonal = 0;
		$fkTransfPersonal = 0;
		$item = 0;
		$fkPersonal = 0;
		$observacion = '';
		$this->sequencia = "spdettransfpersonal_pkdettransfpersonal_seq";
	}
	public function guardarModel(){
		if($this->pkDetTransfPersonal <= 0){
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
			echo "[DetTransfPersonalModel.addModel]" . $e->getMessage();
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[DetTransfPersonalModel.editModel] " . $e->getMessage();
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkdettransfpersonal"] = $this->pkDetTransfPersonal;
			return $parametros;
	}
	private function getParametros(){
		$parametros = array();			
		$parametros[":fktransfpersonal"] = $this->fkTransfPersonal;
		$parametros[":item"] = $this->item;
		$parametros[":fkpersonal"] = $this->fkPersonal;
		$parametros[":observacion"] = $this->observacion;
		
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
			$consulta .= " d.pkDetTransfPersonal, d.fkTransfPersonal, d.item,  ";
			$consulta .= " d.fkPersonal, d.observacion, CONCAT(p.nombreComp , p.apellidos) as personal ";
			
			$consulta .= " FROM spdettransfpersonal d ";
			$consulta .= " 	INNER JOIN sppersonal p ON d.fkPersonal = p.pkPersonal ";

			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[DetTransfPersonalModel.listar]"  . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
		echo "[DetTransfPersonalModel.delModel]" . $e->getMessage();
		}
	}

	/**
	 * Metodo que devuelve un detalle de transferencia a partir de la llave primaria.
	 * @param  [entero] $pkDetTransfPersonal Llave primaria del detalle transferencia de personal
	 * @return [Array] Devuelve una array con los atributos de la tabla.
	 */
	public function getDetTransfPersonal($pkDetTransfPersonal){
		try {
			$listado = $this->listar(" pkDetTransfPersonal = " . $pkDetTransfPersonal);

			if(count($listado)>0)
				return $listado[0];
			else
				return null;
		} catch (PDOException $e) {
			echo '[DetTransfPersonalModel.getDetTransfPersonal] '. $e->getMessage();
			return null;
		}
	}

	/**
	 * Metodo que devuelve todo el detalle de transferencia
	 * @param  [Entero] $fkTransfPersonal Identificador primario de transferencia
	 * @return [Array] [description]
	 */
	public function getTodosDetTransfPersonal($fkTransfPersonal){
		try {
			$listado = $this->listar(" fkTransfPersonal = " . $fkTransfPersonal);
			
			return $listado;		
		} catch (PDOException $e) {
			echo '[DetTransfPersonalModel.getTodosDetTransfPersonal]' . $e->getMessage();
			return null;
		}
	}
}
?>