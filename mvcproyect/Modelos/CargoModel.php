<?php
class CargoModel extends ModelBase{

	public $pkCargo;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spcargo';
		$pkCargo = 0;
		$codigo = '';
		$descripcion = '';
	}

	public function guardarModel(){
		if($this->pkCargo <= 0){
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
			echo "Error Editar : " .$e->getMessage();	
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkCargo"] = $this->pkCargo;
			return $parametros;
	}
	private function getParametros($tipo){
		
		$parametros = array();			
	
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;

		if($tipo == 0) // insertar
			$parametros[":pkCargo"] = $this->pkCargo;

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
			$consulta  = " SELECT pkCargo, codigo, descripcion FROM " . $this->tabla;
			
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[CargoModel.listar] " .$e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);
		} catch (PDOException $e) {
			echo "Error Eliminar : " . $e->message();
		}
	}
	# devuelve un cargo
	public function getCargo($pkCargo){
		try {
			$listado = $this->listar(" pkCargo = " . $pkCargo);
			$listados = $listado->fetchAll();
			if(count($listados)>0)
				return $listados[0];
			else
				return null;
		} catch (PDOException $e) {
			echo 'error : cargo';
			return null;
		}
	}
}

?>