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
	date_default_timezone_set('UTC');
	
	// --- GENERAL DEFINATIONS ----
	define('SALT_CSRF_TOKEN', md5('shiro'));
	define('BASE_URL', 'http://localhost/Mail-Management-Tool/');
	$BASE_URL = BASE_URL;
	define('CAMPAIGN_START', $BASE_URL.'api/index.php');
	define('API_LINK_URL', $BASE_URL.'links/index.php');
	define('UNSUBSCRIBE_URL', $BASE_URL.'unsubscription.php');
	define('DEFAULT_SENDER', 'noreply@todofy.org');
	define('DEFAULT_SUBJECT', 'TODOFY Mail');

	// -- define logging related logs
	define('LOG_FILE_NORMAL', __DIR__ .'/../logs/log_normal.log');
	define('LOG_FILE_ERROR', __DIR__ .'/../logs/log_error.log');
	define('LOG_FILE_WARNING', __DIR__ .'/../logs/log_warning.log');
	define('LOG_FILE_ATTACK', __DIR__ .'/../logs/log_attack.log');
	define('LOG_FILE_WEBHOOK', __DIR__ .'/../logs/log_webhook.log');
		
	define('LOG_NORMAL', 1);
	define('LOG_ERROR', 2);
	//define('LOG_WARNING', 3);
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

	define('ADD_ADMIN', 'admin_add');
	define('VIEW_ADMIN', 'admin_view');
	define('DELETE_ADMIN', 'admin_delete');
	define('EDIT_ADMIN', 'admin_edit');
	define('REVOKE_ADMIN', 'admin_revoke');
	define('VIEW_CAMPAIGN', 'campaign_view');
	define('CALL_CAMPAIGN', 'campaign_call');
	define('UNSUB_EMAILS', 'unsub_emails');
	
	define('SALT', 'namak');
	define('REMEMBER_ME_COOKIE', 'remember');

	// --- global function from now
	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
}

?>
