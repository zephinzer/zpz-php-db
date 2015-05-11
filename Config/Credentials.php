<?php namespace zpz\DB;
require_once(__DIR__.'/../Exceptions/CredentialsNotFound.php');
require_once(__DIR__.'/../DB.php');
/**
 * @author Joseph Matthias Goh <joseph@zephinzer.com>
 */
class Credentials {
	/**
	 * Variable to store the hostname, schema name,
	 * username and password for a database connection.
	 * 
	 * @var array
	 */
	private static $secret = array(
		/**
		 * Name of driver to use
		 */
		ZPZ_DB_DRIVER=>NULL,
		/**
		 * Hostname/IP address of server
		 */
		ZPZ_DB_HOST=>NULL,
		/**
		 * Port to connect to
		 */
		ZPZ_DB_PORT=>NULL,
		/**
		 * What charset to use
		 */
		ZPZ_DB_CHARSET=>NULL,
		/**
		 * Schema name
		 */
		ZPZ_DB_SCHEMA=>NULL,
		/**
		 * Username for connecting user
		 */
		ZPZ_DB_USERNAME=>NULL,
		/**
		 * Password for connecting user
		 */
		ZPZ_DB_PASSWORD=>NULL,
	);
	/**
	 * Initializes this class.
	 */
	public static function init() {
		set_error_handler('\zpz\DB\Credentials::error');
		static::$secret = array(
			ZPZ_DB_DRIVER=>ZPZ_DB_CONFIG_DRIVER,
			ZPZ_DB_HOST=>ZPZ_DB_CONFIG_HOST,
			ZPZ_DB_PORT=>ZPZ_DB_CONFIG_PORT,
			ZPZ_DB_CHARSET=>ZPZ_DB_CONFIG_CHARSET,
			ZPZ_DB_SCHEMA=>ZPZ_DB_CONFIG_SCHEMA,
			ZPZ_DB_USERNAME=>ZPZ_DB_CONFIG_USERNAME,
			ZPZ_DB_PASSWORD=>ZPZ_DB_CONFIG_PASSWORD
		);
		set_error_handler(NULL);
	}
	/**
	 * Error handler for missing credentials
	 * @return void
	 * @throws \zpz\DB\Exceptions\CredentialsNotFound
	 */
	public static function error($errorNumber, $errorMessage, $errorFile, $errorLine, $errorContext) {
		if(strpos($errorMessage, 'undefined constant') !== FALSE) {
			throw new \zpz\DB\Exceptions\CredentialsNotFound($errorMessage);
		}
	}
	/**
	 * Retrieves the credentials in an array as specified
	 * in the instance variable $secret.
	 * @return array
	 */
	public static function get($arrayKey = NULL) {
		if(isset($arrayKey)) {
			return static::$secret[$arrayKey];
		}
		return static::$secret;
	}
}
?>