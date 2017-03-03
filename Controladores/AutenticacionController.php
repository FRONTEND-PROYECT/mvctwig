<?php 
require_once 'Modelos/GrupoModel.php';
require_once 'Modelos/UsuarioModel.php';
require_once "Modelos/ModuloGrupoModel.php";


class AutenticacionController extends ControllerBase
{
	public function __construct(){
		parent::__construct();
	}
	public function login()
	{
		#verificamos si tenemos iniciada una session
		session_start();
		if(isset($_SESSION["nickname"])){			
			if($this->loginIsValid($_SESSION["nickname"], $_SESSION["password"])){
				session_write_close();
				//echo "[AutenticacionController.login] Session sin cerrar";
				$this->iniciarSession();
			}else{
				session_write_close();
				//echo "[AutenticacionController.login] Usuario no valido";
				$this->mostrar("AutenticacionView.php", null);
			}
		}else{
			session_write_close();
			//echo "[AutenticacionController.login] Session no encontrada";
			$this->mostrar("AutenticacionView.php", null);
		}
	}
	/**
	 * Metodo que nos muestra la vista de inicio
	 * @return [type] [description]
	 */
	public function inicio(){
		$this->show('IndexView.php', null);
	}
	public function validar(){
		$result = array();

		$usr = new UsuarioModel();
		$listado  = $usr->buscarUsuario($_POST["nickname"]);		
		
		$result = array();

		if(! is_null($listado)){			
			if($listado->password == $_POST["password"]) {# son iguales
				$result["nickname"] = $listado->nickname;
			 	$result["fkgrupousuario"] = $listado->fkgrupousuario;
			 	$result["pkusuario"] = $listado->pkusuario;
			 	$result["status"] = "correcto";
			}else{
				$result["status"] = "error";
			}
		}else{
			$result["status"] = "error";
		}

		echo json_encode($result);
	}
	/**
	 * Metodo que verifica si un inicio de session es valido
	 * @param $nick nombre de usuario
	 * @param $pass contraseña de usuario
	 * @return true o false
	 */
	private function loginIsValid($nick, $pass){
		$usuario = new UsuarioModel();
		$listado  = $usuario->buscarUsuario($nick);
		if(!is_null($listado)){			
			if($listado->password == $pass)
				return true;
			else
				return false;
		}else{
			return false;
		}	
	}

	# Muestra la pagina que le pasemos
	private function mostrar($vista, $listado){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$this->show($vista, $data);
	}

# controladores del principal
# -------------------------------------------------------------------
# -------------------------------------------------------------------
	public function iniciarSession(){
		session_start();
		if(!isset($_SESSION["nickname"])){  # no esta definida la session
			$_SESSION["nickname"] = $_POST["nickname"];
			$_SESSION["password"] = $_POST["password"];

			$menu = $this->getMenu($_SESSION["nickname"], $_SESSION["password"]);
			$this->mostrarVistaMenus($menu, "PrincipalView.php");
			//$this->mostrar($menu, "prueba.php");
		}else{
			# session esta definida y mostramos el munu
			//echo "[PrincipalController.iniciarSession] session definida!!";
			$menu = $this->getMenu($_SESSION["nickname"], $_SESSION["password"]);
			$this->mostrarVistaMenus($menu, "PrincipalView.php");
			//$this->mostrar($menu, "pruebaView.php");
			# si habillito esto despues de dar F5 a la pagina 
			# cerrara la session y hara que inicie la sesion de nuevo
			//$this->cerrarSession();
		}
	}

	public function cerrarSession(){
		echo "Llegue hasta cerrar session del servidor controller";
		session_start();
		session_unset();
  		session_destroy();
  		echo "entre aqui!!!!!!!!!!!!!!!!!!!!!!!!!!";
  		header("Location: ./");
	}
	/**
	 * Metodo que obtiene todos los accesos a los que puede ingresar el usuario
	 * @param  [type] $nick [description]
	 * @return [type]       [description]
	 */
	private function getMenu($nick, $password){
		$usuario = new UsuarioModel();
		$modgrp = new ModuloGrupoModel();

		$usr = $usuario->buscarUsuario($nick);

		if(!is_null($usr)){
			if($usr->password == $password){
				#si es valido busco sus menus
				$listado = $modgrp->getModulos($usr->fkgrupousuario);
				if(!is_null($listado)){					
					return $listado;
				}else{
					# si no encuentra nada solo mostrar algo
					echo "no se encontro ningun permiso!!";
				}
			}
		}

		return null;
	}
	/**
	 * Muestra a vista
	 * @param  [Array] $menu Array con los metodos de acceso
	 * @param  [type] $vista   El nombre de la vista que se mostrara
	 */
	private function mostrarVistaMenus($menus, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['menus'] = $menus;
		$this->show($vista, $data);
	}

#============================================================== 


}

?>