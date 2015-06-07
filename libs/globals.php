<?php
/**
 * @library - global definations
 * Library stores all gobal definations, database credentials etc
 * @dependencies - none
 */

if (!isset($SECURE)) {
	echo 'We do not show contents to hackers! Try a different way naive!';
	exit;
}

if (!isset($_DEF_GLOBALS_)) {
	// to avoid mutiple redefinations
	$_DEF_GLOBALS_ = true;

	define('__TIME_STARTED', time());
	
	// --- GENERAL DEFINATIONS ----
	define('SALT_CSRF_TOKEN', md5('shiro'));
	define('BASE_URL', '');
	$BASE_URL = BASE_URL;

	// -- define logging related logs
	define('LOG_FILE_NORMAL', __DIR__ .'/../logs/log_normal.log');
	define('LOG_FILE_ERROR', __DIR__ .'/../logs/log_error.log');
	define('LOG_FILE_WARNING', __DIR__ .'/../logs/log_warning.log');
	define('LOG_FILE_ATTACK', __DIR__ .'/../logs/log_attack.log');
	define('LOG_FILE_WEBHOOK', __DIR__ .'/../logs/log_webhook.log');
		
	define('LOG_NORMAL', 1);
	define('LOG_ERROR', 2);
	define('LOG_WARNING', 3);
	define('LOG_ATTACK', 5);
	define('LOG_WEBHOOK', 6);
	define('LOG_EMAIL_ID', '');

	// --- DATABASE DEFINATIONS ----
	define('HOST', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DATABASE', 'mmt');
	define('MYSQL_QUERY_FAILED', 0);
	define('MYSQL_QUERY_SUCCESS', 1);

	// --- global function from now
	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
}

?>