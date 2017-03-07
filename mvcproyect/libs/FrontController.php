<?php 

class FrontController
{
	
	static function main(){
		try {
			//incluimos las clases necesarias
			require_once 'libs/Config.php';
			require_once 'libs/SPDO.php';
			
			require_once 'libs/View.php';
			require_once 'libs/ControllerBase.php';
			require_once 'libs/ModelBase.php';

			require_once 'libs/Configure.php'; //archivo de configuracion
			
			// inicializamos las configuracion de zona
			//  UTC

			date_default_timezone_set('UTC');
			
			if (!empty($_POST['controlador'])) {
				$controllerName = $_POST['controlador'] . 'Controller';
			}else{
				$controllerName = 'AutenticacionController';			
			}
		
			if (!empty($_POST['accion'])) {
				$actionName = $_POST['accion'];
			}else{
				$actionName = 'login';
			}
			$controllerPath = $Configure->get('ControllersFolder') . $controllerName . '.php';
			if (is_file($controllerPath)) {
				require_once $controllerPath;
			}else{
				die('Controlador no existe - 404 No Found');
			}

			// si no existe la clase y su accion , lanzamos un error 404
			if (is_callable(array($controllerName, $actionName), true, $respuesta)== false) {			
				trigger_error($controllerName . '->' . $actionName . ' [$respuesta][No existe]'  , E_USER_NOTICE);
				return false;
			}
			// si todo estas bien creamos una instacia controlador
			$controller = new $controllerName();
			$controller->$actionName();			
		} catch (Exception $e) {
			echo "[FrontController.main]" . $e->getMessage();			
		}
	}
}
?>