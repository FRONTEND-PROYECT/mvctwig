<?php 
/**
* 
*/
class SPDO extends PDO
{
	
	private static $instance = null;

	function __construct()
	{
		$config = Config::singleton();
		
		parent::__construct('pgsql:dbname=' . $config->get('dbname') . 
							';host=' .  $config->get('dbhost'), 
							$config->get('dbuser'), $config->get('dbpass'));

		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function singleton(){
		if(self::$instance == null){
			self::$instance = new self();			
		}

		return self::$instance;
	}
}
 ?>