<?php namespace zpz\DB;
require_once __DIR__.'/../DB.php';
require_once __DIR__.'/../vendor/autoload.php';
$tf = new \Testify\Testify('\zpz\DB Test Suite');
$tf->test('\zpz\DB\Exceptions\CredentialsNotFound should be thrown if ZPZ_DB_CONFIG_* is not set',
	function($tf) {
		try {
			\zpz\DB::get();
		} catch (\zpz\DB\Exceptions\CredentialsNotFound $ex) {
			$tf->pass();
			return;
		}
		$tf->fail();
	}
);
$tf->test('Testing for successful database connection', 
	function($tf) {
		if(!defined('ZPZ_DB_CONFIG_DRIVER'))
			define('ZPZ_DB_CONFIG_DRIVER', 'mysql');
		if(!defined('ZPZ_DB_CONFIG_HOST'))
			define('ZPZ_DB_CONFIG_HOST', '127.0.0.1');
		if(!defined('ZPZ_DB_CONFIG_PORT'))
			define('ZPZ_DB_CONFIG_PORT', '3306');
		if(!defined('ZPZ_DB_CONFIG_CHARSET'))
			define('ZPZ_DB_CONFIG_CHARSET', 'utf8');
		if(!defined('ZPZ_DB_CONFIG_SCHEMA'))
			define('ZPZ_DB_CONFIG_SCHEMA', 'test');
		if(!defined('ZPZ_DB_CONFIG_USERNAME'))
			define('ZPZ_DB_CONFIG_USERNAME','test_user');
		if(!defined('ZPZ_DB_CONFIG_PASSWORD'))
			define('ZPZ_DB_CONFIG_PASSWORD','test_password');
		try {
			\zpz\DB::get();
		} catch (\zpz\DB\Exceptions\CredentialsNotFound $ex) {
			$tf->fail();
			return;
		}
		$tf->pass();
	}
);
$tf();
?>