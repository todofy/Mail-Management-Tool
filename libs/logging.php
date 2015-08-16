<?php
/**
 * @library: logging
 * Deals with all repository "related" info
 * @dependence: database
 */

if(!isset($SECURE)) {
	echo 'We do not show contents to hackers! Try a different way naive!';
	exit;
}

if (!isset($_DEF_LOGGING_)) {
	// to avoid mutiple redefinations
	$_DEF_LOGGING_ = true;

	/**
	 * If size of any log file increases more than a certial limit,
	 * A mail should instantly be sent to the admin, about this
	 * And logs should be read or cleared or backed up in compressed
	 * format
	 */
	class logging
	{
		public static function log($mesg, $category = LOG_NORMAL, $mail = false) {
			switch ($category) {
				case LOG_ERROR: 
					$filename = LOG_FILE_ERROR;
					$cat = "ERROR";
					break;
				case LOG_WARNING: 
					$filename = LOG_FILE_WARNING;
					$cat = "WARNING";
					break;
				case LOG_ATTACK:
					$filename = LOG_FILE_ATTACK;
					$cat = "ATTACK";
					break;
				case LOG_WEBHOOK:
					$filename = LOG_FILE_WEBHOOK;
					$cat = "WEBHOOK";
					break;
				default: 
					$filename = LOG_FILE_NORMAL;
					$cat = "NORMAL";
					break;
			}
			$data = '[' .date("D, d M 20y, H:i:s") .'], ' .$cat .', [' .$_SERVER["SCRIPT_FILENAME"] .'] : ' .$mesg .PHP_EOL;

			if (!file_exists($filename)) file_put_contents($filename, $data);
			else file_put_contents($filename, $data, FILE_APPEND);

			if ($mail) {
				$subject = 'EMERGENCY LOG MMT';
				$message = $data;
				$headers = 'From: webmaster@todo-ci.org' . "\r\n" .
    			'Reply-To: webmaster@todo-ci.org' . "\r\n" .
    			'X-Mailer: PHP/' . phpversion();
				mail(LOG_EMAIL_ID, $subject, $message, $headers);
			}
		}

		// For logging during todofication process
		public static function _tlog($mesg, $id) {
			$file = __DIR__ .'/../_logs/logs/' .$id;
			if (!file_exists($file)) file_put_contents($file, $mesg .PHP_EOL);
			else file_put_contents($file, $mesg .PHP_EOL, FILE_APPEND);
		}
	};
}