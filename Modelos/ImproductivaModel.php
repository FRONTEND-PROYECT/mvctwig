<?php

class ImproductivaModel extends ModelBase{

	public $pkImproductiva;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spimproductiva';
		$this->sequencia = 'spimproductiva_pkimproductiva_seq';
		$pkImproductiva = 0;
		$codigo = '';
		$descripcion = '';
	}

	public function guardarModel(){
		if($this->pkImproductiva <= 0){
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
			echo "Error Adicionar : " .$e->message;
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
			$parametros[":pkimproductiva"] = $this->pkImproductiva;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":codigo"] = $this->codigo;
			
		return $parametros;
	}
	public function listar($where)
	{
		try{
			$consulta = "SELECT pkimproductiva, codigo, descripcion FROM " . $this->tabla;
			if(strlen($where) > 0 ){
				$consulta .= " WHERE " . $where;
			}

			$filas = $this->consultar($consulta);

			return $filas;
		}catch(PDOException $e){
			echo "Error en listar : " .$e->getMessage();
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
	public function getImproductiva($pkImprod){
		try {			
			$listado = $this->listar(" pkimproductiva = " . $pkImprod);

			if(count($listado)>0){
				return $listado[0];
			}
			else
				return null;
		} catch (PDOException $e) {
			echo "[ImproductivaModel.getImproductiva] " . $e->getMessage();
			return null;
		}
	}	
}
?>