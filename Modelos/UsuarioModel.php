<?php
class UsuarioModel extends ModelBase{

	public $pkUsuario;
	public $nickName;
	public $nombreCompleto;
	public $apellidos;
	public $email;
	public $password;
	public $fkGrupoUsuario;

	public function __construct()
	{
		parent::__construct();
		$this->tabla 	= "usuario";
		$pkUsuario 		= 0;
		$nickName 		= "";
		$nombreCompleto	= "";
		$apellidos		= "";
		$email			= "";
		$password		= "";
		$fkGrupoUsuario	= -1;
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
			echo "[UsuarioModel.addModel] " . $e->getMessage();
		}
	}
	public function editModel(){
		try {
			//creamos un array con los parametros
			$parametros = $this->getParametros();
			$paramWhere = $this->getParametrosWhere();
			$this->edit($parametros, $paramWhere);
		} catch (PDOException $e) {
			echo "[UsuarioModel.editModel] " . $e->getMessage();
		}
	}
	private function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkusuario"] = $this->pkUsuario;
			return $parametros;
	}
	private function getParametros(){
		
		$parametros = array();			
		
		$parametros[":nickname"] 		= $this->nickName;
		$parametros[":nombrecompleto"] 	= $this->nombreCompleto;
		$parametros[":apellidos"] 		= $this->apellidos;
		$parametros[":email"] 			= $this->email;
		$parametros[":password"] 		= $this->password;
		$parametros[":fkGrupoUsuario"] 	= $this->fkGrupoUsuario;

		return $parametros;
	}
	public function listar()
	{
		try{
			
			$consulta = "SELECT pkUsuario, nickName, nombreCompleto, apellidos, email, password, fkGrupoUsuario FROM " . $this->tabla;
			return $this->consultar($consulta);
		}catch(PDOException $e){
			echo "[UsuarioModel.listar] " . $e->getMessage();
		}
	}
	public function delModel()
	{
		try {
			//creamos un array con los parametros
			$paramWhere = $this->getParametrosWhere();
			$this->delet($paramWhere);

		} catch (PDOException $e) {
			echo "[UsuarioModel.delModel] " . $e->getMessage();
		}
	}
	/**
	 * Metodo que busca un usuario a partir del nick de usuario
	 * @param  [String] $nick Nombre de usuario
	 * @return [Array] Retorna un array con el usuario. si pudo encontrarse.
	 */
	public function buscarUsuario($nick){
		try{
			$consulta = "SELECT pkUsuario, nickName, nombreCompleto, apellidos, email, password, fkGrupoUsuario FROM " . $this->tabla;
			$consulta =  $consulta . " WHERE nickName = '" . $nick . "'";
			$listado = $this->consultar($consulta);
			if(count($listado)){
				return $listado[0];
			}else{
				return null;
			}
		}catch(PDOException $e){
			echo "[UsuarioModel.buscarUsuario] " . $e->getMessage();
			return null;
		}	
	}

}
?>
