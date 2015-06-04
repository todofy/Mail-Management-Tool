<?php
/**
 * @library - database
 * Library to deal with database related queries
 * @dependencies - logging library
 */

if(!isset($SECURE)) {
	echo 'We do not show contents to hackers! Try a different way naive!';
	exit;
}

if (!isset($_DEF_DATABASE_)) {
	// to avoid mutiple redefinations
	$_DEF_DATABASE_ = true;

	include __DIR__ .'/globals.php';
	include __DIR__ .'/logging.php';

	// @todo - shift this to mysqli
	class database
	{
		private static $con;
		public static $lastError;
		public static $isDatabaseConnected = false;

		public static function Start() {
			self::$con = mysql_connect(HOST, USERNAME, PASSWORD);
			mysql_select_db(DATABASE);
			if (self::$con) {
				self::$isDatabaseConnected = true;
				return MYSQL_QUERY_SUCCESS;
			}
			self::$lastError = mysql_error();
			return  MYSQL_QUERY_FAILED;
		}

		public static function Stop() {
			mysql_close(self::$con);
		}

		public static function Query($statement) {
			$query = mysql_query($statement);
			if (!$query) {
				// Log it!
				logging::log("[MYSQL ERROR] - " .mysql_error() .", line no: " .__LINE__, LOG_ERROR, true);
				logging::log("^ BACKTRACE - " .json_encode(debug_backtrace()), LOG_ERROR);
				$err = mysql_error();
				header("dbase_error: $err");
				header("location: $BASE_URL/dump/404");
				exit;
			}
			return $query;
		}
	};
}

?>