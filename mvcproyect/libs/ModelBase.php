<?php
abstract class ModelBase{
	protected $db;

	protected $where;
	protected $order;
	protected $selec;
	/**
	 * Nombre de la tabla
	 * @var [String]
	 */
	protected $tabla;
	/**
	 * Nombre de la sequencia que genera la llave primaria (solo en postgreSql)
	 * @var [String]
	 */
	protected $sequencia;

	# Aqui estan todas las filas de las consultas
	protected $filas;
	protected $LlavePrimaria;
	
	/**
	 * Constructor base del modelo
	 */
	public function __construct()
	{

		$this->db = SPDO::singleton();
		$LlavePrimaria = -1;
		$this->filas = null;
	}
	/**
	 * Metodo que realizá consultas y devuelve un array de respuesta
	 * @param  [String] $Query El script a ejecutar 
	 * @return [array]  Devuelve un array con los datos devueltos
	 */
	protected function consultar($Query)
	{
		
		$rows = $this->db->query($Query, PDO::FETCH_OBJ);

		$resultado = array();
		
		if($rows == false){
			$resultado = null;
		}else{
			foreach ($rows as $objeto) {
				$resultado[] = $objeto;
			}
		}

		return $resultado;
	}

	/**
	 * Metodo que crea una consulta
	 * @param  [Array] $param  Array con los nombres de todos los parametro
	 * @param  [Numero] $tipo  Puede tener 3 valores [1=insertar, 2=editar, 3=eliminar]
	 * @param  [String] $paramWhere Array con los nombres de los parametros en el where
	 * @return [String] Devuelve una cadena formateada con los parametros
	 */
	private function crearConsulta($param, $tipo, $paramWhere)
	{
		$consulta = "";

		if($tipo == 1) // es una consulta de inserccion
		{
			$consulta = "INSERT INTO " . $this->tabla . "(";
			$i = 0;
			foreach ($param as $atributo => $value) {
				$i = $i + 1;				
				if($i != count($param))
					$consulta .= str_replace(":", "", $atributo)  . ",";
				else
					$consulta .= str_replace(":", "", $atributo) . ")";
			};

			$consulta .= " VALUES (";
			$i = 0;
			foreach ($param as $atributo => $value) {
				$i = $i + 1;
				if($i != count($param))
					$consulta .= $atributo . ",";
				else
					$consulta .= $atributo . ")";	
			};
		}else{ // es una consulta de modificacion
			if($tipo == 2){
				$consulta = "UPDATE " . $this->tabla . " SET ";
				$i = 0;
				foreach ($param as $atributo => $value) {
					$i = $i + 1;				
					if($i != count($param))
						$consulta .= str_replace(":", "", $atributo) . " = " . $atributo . ",";
					else
						$consulta .= str_replace(":", "", $atributo) . " = " . $atributo ;
				};
				// AHORA CONCATENAMOS EL WHERE
				$consulta .= " WHERE ";
				$i = 0;
				foreach ($paramWhere as $atributo => $value) {
					$i = $i + 1;				
					if($i != count($paramWhere))
						$consulta .= str_replace(":", "", $atributo) . " = " . $atributo . " AND ";
					else
						$consulta .= str_replace(":", "", $atributo) . " = " . $atributo ;
				};

			}else{ // es eliminacion ::: 3
				$consulta = "DELETE FROM " . $this->tabla;
				$i = 0;
				if($param != null){
					foreach ($param as $atributo => $value) {

						if($i == 0){
						  	#si viene la primera vez Adicionar el where
							$consulta .= " WHERE ";
						}

						$i = $i + 1;
						if($i != count($param))
							$consulta .= str_replace(":", "", $atributo) . " = " . $atributo . " AND ";
						else
							$consulta .= str_replace(":", "", $atributo) . " = " . $atributo ;
					}
				}
			}
		
		}

		return $consulta;
	}
	/**
	 * Metodo que adiciona una modelo a la base de datos
	 * @param [Array] $parametros son los datos que se guardarán
	 * @return Devuelve true si se guardo correctamente, caso contrario falso
	 */
	protected function add($parametros)
	{
		try{

			$consulta = $this->crearConsulta($parametros, 1, NULL);
			
			$resultado = $this->db->prepare($consulta);
			
			if($resultado->execute($parametros)){				
				$this->LlavePrimaria = $this
											->db
											->lastInsertId($this->sequencia);
				return true;
			}else{
				$this->LlavePrimaria = -1;
				return false;
			}

		}catch(PDOException $e){
			echo "[Error : ModelBase.add] " . $e->getMessage();
			return false;
		}
	}
	/**
	 * Metodo que modifica un modelo
	 * @param  [Array] $parametros Son los datos que se modificaran
	 * @param  [Array] $paramWhere Los parametros de desicion para la edicion
	 * @return [boolean] Devuelve true si la edicion fue correcta, en otro 	cado devuelve falso.
	 */
	protected function edit($parametros, $paramWhere)
	{
		try{
			$consulta = $this->crearConsulta($parametros, 2, $paramWhere);
			$resultado = $this->db->prepare($consulta);

			
			$this->LlavePrimaria = -1;

			if($resultado->execute(array_merge($parametros, $paramWhere))){
				return true;
			}else{
				return false;
			}
			
		}catch(PDOException $e){
			echo "[Error : ModelBase.edit] " . $e->getMessage();
			return false;
		}
	}
	/**
	 * Metodo que elimina todos los que cumplan con la condicion
	 * @param  [Array] $parametros Array de parametros de la condicion
	 * @return [boolean] Devuelve true si se completo correctamente, falso en otro caso.
	 */
	protected function delet($parametros)
	{
		try {
			$consulta = $this->crearConsulta($parametros, 3, NULL);
			$resultado = $this->db->prepare($consulta);

			$this->LlavePrimaria = -1;
			if($resultado->execute($parametros)){
				return true;
			}else{
				return false;
			}
		} catch (PDOException $e) {
			echo "[Error : ModelBase.delet] " . $e->getMessage();
			return false;
		}
	}
}
?>