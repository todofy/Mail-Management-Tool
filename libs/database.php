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
		public static $con = NULL;
		public static $lastError;
		public static $isDatabaseConnected = false;

		public static function Start() {
			self::$con = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);

			if (self::$con) {
				self::$isDatabaseConnected = true;
				return MYSQL_QUERY_SUCCESS;
			}
			self::$lastError = mysql_error();
			return  MYSQL_QUERY_FAILED;
		}

		public static function Stop() {
			self::$con->close();
			self::$con = null;
		}

		public static function Prepare($q) {
			return self::$con->prepare($q);
		}

		public static function mysql_prep($value) {
			$magic_quotes_active = get_magic_quotes_gpc();
			$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
			if( $new_enough_php ) { // PHP v4.3.0 or higher
				// undo any magic quote effects so mysql_real_escape_string can do the work
				if( $magic_quotes_active ) { $value = stripslashes( $value ); }
				$value = mysql_real_escape_string( $value );
			} else { // before PHP v4.3.0
				// if magic quotes aren't already on then add slashes manually
				if( !$magic_quotes_active ) { $value = addslashes( $value ); }
				// if magic quotes are active, then the slashes already exist
			}
			return $value;
		}


		public static function helper($arr) {
		    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
		    {
		        $refs = array();
		        foreach($arr as $key => $value)
		            $refs[$key] = &$arr[$key];
		        return $refs;
		    }
		    return $arr;

		}

		public function SQL ($query, $args) {
	        //If the database isn't connected, connet to it
	        if (self::$con == NULL) self::Start();

	        $statement = self::Prepare($query);   //Prepares an SQL statement

	        //If arguments are passed, then check if the first argument is an array. If yes, then that array contains all the arguments
	        if (!empty($args)) {
	            if (is_array ($args)) {
	            	call_user_func_array(array($statement, "bind_param"), self::helper($args));
	            } else {
	            	logging::log("[DATABASE] invalid arg passed", LOG_ERROR);
	            	logging::log("^ BACKTRACE - " .json_encode(debug_backtrace()), LOG_ERROR);
	            	echo debug_backtrace();
	            	exit;
	            }
	        }

            $statement->execute();

	        $type = substr (trim(strtoupper ($query)), 0, 3);  //get the first three letters of the query
	        if ($type == "INS") //If the query is of insert type
	        {
	            return null;
	        } elseif ($type == "DEL" or $type == "UPD")   //If the query is delete or update, then returns the number of rows affected by the corresponding PDOStatement object.
	        {
	            return $statement->rowCount();
	        }
	        elseif ($type == "SEL")             //If query is select type, then return all the rows returned by the DB
	        {
	            return $statement->fetchAll();
	        }
	        return null;    //If none of the above types match, then probable that query is wrong and thus return null
	    }
	};
}

?>