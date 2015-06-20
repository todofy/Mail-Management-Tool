<?php
/**
 * @library: Session
 * library to deal with session related queries, to maintain and retrieve the session
 * data easily
 * @dependency: none
 */
if(!isset($SECURE)) {
	echo 'We do not show contents to hackers! Try a different way naive!';
	exit;
}

if (!isset($_DEF_SESSION_)) {
	// to avoid mutiple redefinations
	$_DEF_SESSION_ = true;

	include __DIR__ .'/login.php';;

	class session {
		public $state;
		public $user_id;

		public function __construct() {
			if (isset($_SESSION['user_id'])) {
				// means session is possibly set
				// step 1: verify for USER_AGENT
				if (!isset($_SESSION['HTTP_USER_AGENT']) ||
					($_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT'])) {
					self::destruct();
					$this->state = false;
					return;
				}

				$this->user_id = $_SESSION['user_id'];
				$this->state = true;
				return;
			} else if (isset($_COOKIE['remember'])) {
				// Possiblity of remember me option
				// if a correct cookie is set, it will automatically set
				// session
				$this->state = login::verifyCookieToRemember();
				return;
			}

			$this->state = false;
		}

		public static function destruct() {
			if (isset($_SESSION['user_id'])) unset($_SESSION['user_id']);
			if (isset($_SESSION['HTTP_USER_AGENT'])) unset($_SESSION['HTTP_USER_AGENT']);
			unset($_SESSION);		
		}

		public static function Set($user_id) {
			$_SESSION['user_id'] = $user_id;
			$_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
		}
	};

}
?>