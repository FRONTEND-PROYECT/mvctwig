<?php
require_once "Negocio/FuncionesComunes.php";

class GestionModel extends ModelBase{

	public $pkGestion;
	public $codigo;
	public $fechaIni;
	public $fechaFin;
	public $estado;

	public function __construct(){
		parent::__construct();
		$this->tabla = 'spgestion';
		$this->secuencia = 'spgestion_pkgestion_seq';
		$pkGestion = 0;
		$codigo = '';
		$fechaIni = '1990-01-01';
		$fechaFin = '1990-01-01';
		$estado = 'F';
	}
	public function guardarModel(){
		if($this->pkGestion <= 0){
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
			echo "[GestionModel.addModel] " . $e->getMessage();
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[GestionModel.editModel] " . $e->getMessage();
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkgestion"] = $this->pkGestion;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fechaini"] = $this->fechaIni;
		$parametros[":fechafin"] = $this->fechaFin;
		$parametros[":estado"] = $this->estado;
		
		return $parametros;
	}
	/**
	 * Devuelve un array de objetos los atributos son las columnas de la tablas
	 * @param  [String] $where Condicion de la consulta
	 * @return Array de objetos con atributo se puede acceder[$modelo->nombreColumna]
	 */
	public function listar($where){
		try{
			$consulta = "SELECT pkgestion, codigo, fechaini, fechafin, estado FROM " . $this->tabla;
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			
			$filas = $this->consultar($consulta);
			# debo realizar los cambios de la fecha
			foreach ($filas as $value) {

				$value->fechaini = FuncionesComunes::cambiarFormato($value->fechaini);
				$value->fechafin = FuncionesComunes::cambiarFormato($value->fechafin);

			}
			return $filas;
		}catch(PDOException $e){
			echo "[GestionModel.listar] " . $e->getMessage();
		}
	}
	/**
	 * Metodo que elimina la gestion con los parametros ingresados
	 * @return [boolean] Retorna true si se elimino correctamente, falso en otro caso
	 */
	public function delModel(){
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			return $this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[GestionModel.delModel] " . $e->getMessage();
			return false;
		}
	}

	/**
	 * Metodo que devuelve una gestion a partir de la llave primaria
	 * @param  [Entero] $pkGestion Llave primaria
	 * @return [Gestion]  Devuelve un objeto gestion 
	 */
	public function getGestion($pkGestion){
		try {
			$listado = $this->listar(" pkgestion = " . $pkGestion);

			if(count($listado)>0){
				return $listado[0];
			}
			else
				return null;
		} catch (PDOException $e) {
			echo "[GestionModel.getGestion] " . $e->getMessage();
			return null;
		}
	}
	/**
	 * Metodo que devuelve la gestion activa del sistema
	 * @return [Gestion]  Devuelve un objeto gestion
	 */
	public function getGestionActiva(){
		try {
			$listado = $this->listar(" estado = 'T' ");

			if(count($listado)>0){
				return $listado[0];
			}
			else
				return null;
		} catch (Exception $e) {
			echo "[GestionModel.getGestion] " . $e->getMessage();
			return null;
		}
	}	
}
?>