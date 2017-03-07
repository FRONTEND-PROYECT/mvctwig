<?php
require_once('Negocio/FuncionesComunes.php');
class PersonalModel extends ModelBase{

	public $pkPersonal;
	public $fechaIngreso;
	public $nombreComp;
	public $apellidos;
	public $direccion;
	public $telefono;
	public $ci;
	public $fechaNac;
	public $fkCargo;
	public $fkOrdenTrabajo;
	public $email;
	

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'sppersonal';
		$pkPersonal = 0;
		$fechaIngreso = '1990-01-01';
		$nombreComp = '';
		$apellidos = 0;
		$direccion = '';
		$telefono = '';
		$ci = '';
		$fechaNac = '1990-01-01';
		$fkCargo = 0;
		$fkOrdenTrabajo = 0;
		$email = '';
	}
	
	public function guardarModel(){
		if($this->pkPersonal <= 0){
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
			echo "[PersonalModel.addModel] " .$e->getMessage();
		}
	}
	private function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo '[PersonalModel.editModel] ' . $e->getMessage();
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkpersonal"] = $this->pkPersonal;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
	
		$parametros[":fechaIngreso"] 	= $this->fechaIngreso;
		$parametros[":nombreComp"] 		= $this->nombreComp;
		$parametros[":apellidos"] 		= $this->apellidos;
		$parametros[":direccion"] 		= $this->direccion;
		$parametros[":telefono"] 		= $this->telefono;
		$parametros[":ci"]				= $this->ci;
		$parametros[":fechaNac"]		= $this->fechaNac;
		$parametros[":fkCargo"] 		= $this->fkCargo;
		$parametros[":fkOrdenTrabajo"] 	= $this->fkOrdenTrabajo;
		$parametros[":email"] 			= $this->email;
	
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
			$consulta = " SELECT p.pkPersonal, p.fechaIngreso, p.nombreComp, p.apellidos, ";
			$consulta .= " p.direccion, p.telefono, p.ci, p.fechaNac, p.fkCargo, p.fkOrdenTrabajo, p.email, ";
			$consulta .= " c.descripcion, o.data, o.nombre";
			$consulta .= " FROM sppersonal p ";
			$consulta .= " INNER JOIN spcargo c ON p.fkcargo = c.pkCargo ";
			$consulta .= " INNER JOIN spordentrabajo o ON p.fkOrdenTrabajo = o.pkOrdenTrabajo ";
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}

			$filas = $this->consultar($consulta);

			# debo realizar los cambios de la fecha
			foreach ($filas as $value) {

				$value->fechaingreso = FuncionesComunes::cambiarFormato($value->fechaingreso);
				$value->fechanac = FuncionesComunes::cambiarFormato($value->fechanac);

			}

			return $filas;

		}catch(PDOException $e){
			echo "[PersonalModel.listar] " .$e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);
		} catch (PDOException $e) {
			echo "[PersonalModel.delModel] " . $e->getMessage();
		}
	}
	/**
	 * Metodo que devuelve un personal a partir del identificador primario
	 * @param  [Entero] $pkPersonal Llave primaria del personal
	 * @return [Array] Devuelve un array en cuyo contenido estan los atributos de la tabla
	 */
	public function getPersonal($pkPersonal){
		try {
			$listado = $this->listar(" pkpersonal = " . $pkPersonal);
			
			if(count($listado)>0)
				return $listado[0];
			else
				return null;
		} catch (PDOException $e) {
			echo "[PersonalModel.getPersonal]" . $e->getMessage();
			return null;
		}
	}

}
?>