<?php 
/**
* Clase encargada de representar las vistas con los datos que llegan.
*/
class View
{

	function __construct(){
	
	}
	/**
	* Metodo que llama a la plantilla donde se representaran todos los datos.
	* @param $name Nombre de la plantilla mostrar.
	* @param $vars Es un array con todas las variables que se mostraran en la plantilla.
	**/
	public function show($name, $vars){
		
		$config = Config::singleton();
		
		$path = $config->get('ViewsFolder') . $name;

		if (file_exists($path) == false) {
			trigger_error('Plantilla de la vista ' . $path . 'No existe!!', E_USER_NOTICE);
			return false;
		}

		if (is_array($vars)) {
			foreach ($vars as $key => $value) {
				$$key = $value;
			}
		}

		//finalmete incluimos a la plantilla
		include ($path);
	}
} 
?>