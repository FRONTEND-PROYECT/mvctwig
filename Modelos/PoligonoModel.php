<?php
class PoligonoModel extends ModelBase{

	public $pkPoligono;
	public $fkOrdenTrabajo;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'sppoligono';
		$pkPoligono = 0;
		$fkOrdenTrabajo = 0;
		$codigo = '';
		$descripcion = '';
	}

	public function guardarModel(){
		if($this->pkPoligono <= 0){
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
			$parametros[":pkPoligono"] = $this->pkPoligono;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
		$parametros[":fkOrdenTrabajo"] = $this->fkOrdenTrabajo;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;

		if($tipo == 0) // insertar
			$parametros[":pkPoligono"] = $this->pkPoligono;

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
			$consulta = "SELECT pkPoligono, fkOrdenTrabajo, codigo, descripcion FROM " . $this->tabla;
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[PoligonoModel.listar]" . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[PoligonoModel.listar]" . $e->getMessage();
		}
	}

}
?>