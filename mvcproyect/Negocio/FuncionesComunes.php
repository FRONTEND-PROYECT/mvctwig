<?php
require_once "Modelos/GestionModel.php";
class FuncionesComunes{
	# funcion que devuelve el codigo de gestion a partir de la llave primaria
	public static function getGestionCodigo($pkGestion){
		try {
			$ges = new GestionModel();

			$listado = $ges->listar(" pkGestion = " . $pkGestion);
			$listados = $listado->fetchAll();
			if(count($listados)>0)
				return $listados[0]['codigo'];
			else
				return 0;
		} catch (PDOException $e) {
			return 0;
			echo "Error en [getGestionCodigo]" .$e->getMessage();
		}
	}

	/**
	 * Metodo que formatea la fecha
	 * @param  [String] $fecha La fecha en otro formato
	 * @return [String]        Resultado del nuevo formato
	 */
	public static function cambiarFormato($fecha){		
		$lista = explode("-", $fecha);
		$fechaFormato = $lista[2].'-'.$lista[1].'-'.$lista[0];

		return $fechaFormato;
	}
}
?>