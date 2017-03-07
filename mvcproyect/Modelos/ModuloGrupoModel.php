<?php
class ModuloGrupoModel extends ModelBase{

	public $fkGrupo;
	public $fkModulo;
	public $fkAccion;
	public $fechaInstall;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'modulogrupo';
		$fkGrupo = 0;
		$fkModulo = 0;
		$fkAccion = 0;
		$fechaInstall = date("d-M-Y");
	}

	public function addModel()
	{
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			if($this->add($parametros))
				return true;
			else
				return false;

		} catch (PDOException $e) {
			echo "[ModuloGrupoModel.addModel]" . $e->getMessage();
		}
	}
	public function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[ModuloGrupoModel.editModel]" . $e->getMessage();
		}		
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":fkGrupo"] = $this->fkGrupo;
			$parametros[":fkModulo"] = $this->fkModulo;
			$parametros[":fkAccion"] = $this->fkAccion;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
		$parametros[":fechaInstall"] = $this->fechaInstall;

		return $parametros;
	}
	public function listar()
	{
		try{			
			$consulta = "SELECT fkaccion, fkmodulo, fkgrupo, fechaInstall FROM " . $this->tabla;
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[ModuloGrupoModel.listar]" . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[ModuloGrupoModel.delModel]" . $e->getMessage();
		}
	}
	/**
	 * Metodo que devuelve todos los modulos que tiene acceso el grupo
	 * @param  [Integer] $pkGrupo Identificador de Grupo de usuarios
	 * @return [Array]   Lista de array de menu
	 */
	public function getModulos($pkGrupo){
		try{			
			$consulta = "SELECT ";
			$consulta .= " g.descripcion as grupo,";
			$consulta .= " m.descripcion as descmenu,";
			$consulta .= " m.nombrefile, m.idmenu";
			$consulta .= " FROM modulogrupo mg";
			$consulta .= " inner join modulo m on mg.fkmodulo = m.pkmodulo";
			$consulta .= " inner join grupo  g on mg.fkgrupo = g.pkgrupo";
			$consulta .= " inner join accion a on mg.fkaccion = a.pkaccion";
			$consulta .= " WHERE mg.fkgrupo = " . $pkGrupo;
			$consulta .= " GROUP BY g.descripcion, m.descripcion, m.nombrefile, m.idmenu";
			$consulta .= " ORDER BY 2 ";

			
			return $this->consultar($consulta);

		}catch(PDOException $e){
			echo "[ModuloGrupoModel.getModulos]" . $e->getMessage();
			return null;
		}				
	}
	/**
	 * Metodo  que nos devuelve todos los accesos de un modulo
	 * @param  [integer] $pkGrupo Identificador primario de grupo
	 * @param  [integer] $pkModulo Identificador primario de modulo
	 * @return [Array] Lista de accesos
	 */
	public function getAccesos($pkGrupo, $pkModulo){
		try{			
			$consulta = " SELECT ";
			$consulta .= " a.pkaccion, a.codigo, a.descripcion, a.estado";
			$consulta .= " FROM modulogrupo mg";
			$consulta .= " INNER JOIN accion a on mg.fkaccion = a.pkaccion";
			$consulta .= " WHERE mg.fkgrupo = " . $pkGrupo;
			$consulta .= " AND mg.fkmodulo = " . $pkModulo;
			
			return $this->consultar($consulta);

		}catch(PDOException $e){
			echo "[ModuloGrupoModel.getAccesos]" . $e->getMessage();
			return null;
		}				
	}	
}
?>