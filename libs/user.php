<?php
/**
 * @library - user
 * Library to deal with all the properties of the user
 * @dependencies - logging library, database
 */

if(!isset($SECURE)) {
  echo 'We do not show contents to hackers! Try a different way naive!';
  exit;
}

if (!isset($_DEF_USER_)) {
	$_DEF_USER_ = true;

	class user
	{
		public $username;
		public $email;
		public $user_id;

		// Load all the access for this user in this array
		public $access = array();

		function __construct($user_id) {
			// get data about this user
<<<<<<< HEAD
			$q = database::SQL("SELECT `email` FROM `admin` WHERE `id` = ?;", array('s', $user_id));
=======
			$q = database::Query("SELECT `email` FROM `admin` WHERE `id` = ?;", array('s', $user_id));
>>>>>>> origin/master
			if (isset($q[0])) {
				$this->user_id = $user_id;
				$this->email = $q[0]['email'];
			} else {
				throw new Exception("Invalid user id sent for creating a user", 1);
			}

			// Get all the access for this user
			$q = database::SQL("SELECT `acl`.`name` FROM `admin_access`
				INNER JOIN `acl` ON `acl`.`id` = `admin_access`.`access_id`
				WHERE admin_id = ?;", array('s', $user_id));
			foreach ($q as $value) {
				$this->access[] = $value['name'];
			}
		}

		// Function to update information about this user
		// to the database
		public function updateInfo() {
			// #todo - implement this functionality
		}

		/**
		 * Function to check if a certain access with access name as
		 * {$accessName} is set for this user
		 */
		public function hasAccessForThis($accessName) {
			foreach ($this->access as $value) {
				if ($value == $accessName) return true;
			}
			return false;
		}
	};
}