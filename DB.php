<?php namespace zpz;
define('ZPZ_DB_DRIVER', 'driver');
define('ZPZ_DB_HOST', 'host');
define('ZPZ_DB_PORT', 'port');
define('ZPZ_DB_CHARSET', 'charset');
define('ZPZ_DB_SCHEMA', 'schema');
define('ZPZ_DB_USERNAME', 'username');
define('ZPZ_DB_PASSWORD', 'password');
require_once __DIR__."/Config/Credentials.php";
/**
 * Singleton class for database access
 */
class DB {
	private static $db = NULL;
	private static $pdoException = NULL;
	/**
	 * Constructs the instance of this class using the
	 * $driver database connector, connecting to the host
	 * identified by $host at port $port. The name of the
	 * schema being connected to is $name and the user
	 * credentials are the $username and $password. The
	 * schema should be using the charset $charset. 
	 * 
	 * @param string $driver
	 * @param string $host
	 * @param string $port
	 * @param string $name
	 * @param string $charset
	 * @param string $username
	 * @param string $password
	 */
	private function __construct($driver, $host, $port, $name, $charset, $username, $password) {
		try {
			static::$db = new \PDO(
				"$driver:host=$host;port=$port;dbname=$name;charset=$charset",
				$username, $password, array(
					\PDO::ATTR_EMULATE_PREPARES => false,
					\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
				)
			);
		} catch(\PDOException $pdoException) {
			static::$db = NULL;
			static::$pdoException = $pdoException;
		}
	}
	/**
	 * Public static function to retrieve the singleton
	 * instance of this class. Checks if already initialized,
	 * if not initializes it. Returns it in all scenarios.
	 * 
	 * @return \zpz\DB
	 */
	public static function get() {
		if(!isset(static::$db)) {
			DB\Credentials::init();
			$credentials = DB\Credentials::get();
			new DB(
				$credentials[ZPZ_DB_DRIVER],
				$credentials[ZPZ_DB_HOST],
				$credentials[ZPZ_DB_PORT],
				$credentials[ZPZ_DB_SCHEMA],
				$credentials[ZPZ_DB_CHARSET],
				$credentials[ZPZ_DB_USERNAME],
				$credentials[ZPZ_DB_PASSWORD]
			);
		}
		return static::$db;
	}
}

?>