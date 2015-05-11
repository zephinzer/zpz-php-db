<?php namespace zpz\DB;
// configure these to your settings
define('ZPZ_DB_CONFIG_DRIVER', 'mysql');
define('ZPZ_DB_CONFIG_HOST', '127.0.0.1');
define('ZPZ_DB_CONFIG_PORT', '3306');
define('ZPZ_DB_CONFIG_CHARSET', 'utf8');
define('ZPZ_DB_CONFIG_SCHEMA', '[SCHEMA_NAME]');
define('ZPZ_DB_CONFIG_USERNAME','[USERNAME]');
define('ZPZ_DB_CONFIG_PASSWORD','[PASSWORD]');
require_once(__DIR__.'/DB.php');
// use \zpz\DB::get() to access the PDO object
?>