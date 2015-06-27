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

	/**
	 * DATABASE CLASS DEALS WITH ALL DATABASE RELATED ACTIVITIES
	 */
	class database
	{
		public static $con = NULL;						// will store the database connection object
		public static $lastError;						// to store last occured error
		public static $isDatabaseConnected = false;		// (bool) states if db is connected or not

		/**
		 * Function to trigger database connection
		 * @return (int) MYSQL_QUERY_SUCCESS or MYSQL_QUERY_FAILED as per case
		 */
		public static function Start() {
			self::$con = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);

			if (self::$con) {
				self::$isDatabaseConnected = true;
				return MYSQL_QUERY_SUCCESS;
			}
			self::$lastError = mysql_error();
			return  MYSQL_QUERY_FAILED;
		}

		/**
		 * Function to stop active database connection
		 * @return void
		 */
		public static function Stop() {
			self::$con->close();
			self::$con = null;
			self::$isDatabaseConnected = false;
		}

		/**
		 * Function to filter any variable before mysql query execurtion
		 * @param $value - (string) filters the variable
		 * @return string, filtered variable
		 */
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

		/**
		 * helper function to convert an array to array reference
		 * for call_user_func_array and mysqli::bind_param 
		 * @param $arr - (array) 
		 * @return array reference
		 */
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

		/**
		 * Function to execute a SQL query
		 * @param $query - (string) the raw SQL Query before binding
		 * @param $args - (array) arr[0] - type of parameters, arr[1,2,3....,n] the parameter as in mysqli::bind_param
		 *
		 * @return 
		 * null - in case of INSERT or alter and stuff
		 * int, rowcount in case of update and delete
		 * array, data in case of select statment
		 */
		public static function SQL ($query, $args = array()) {
	        //If the database isn't connected, connet to it
	        if (self::$con == NULL) self::Start();

	        $statement = self::$con->prepare($query);   //Prepares an SQL statement

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
	        //If the query is of insert type
	        if ($type == "INS") {
	            return null;
	            // #todo - return the id of the inseted data if possible
	            // requires all tables to have a id
	        } elseif ($type == "DEL" or $type == "UPD") {
	        	//If the query is delete or update, then returns the number of rows affected by the corresponding PDOStatement object.
	            //return $statement->rowCount();
	            return self::$con->affected_rows;
	        } elseif ($type == "SEL") {
	        	 //If query is select type, then return all the rows returned by the DB
	        	//to get the resdult in the form of an associative array use:
	        	//$row=$result->fetch_array(MYSQLI_ASSOC); 
	        	//$row['id']
	        	//where $result = return value of this function 
	            $result= $statement->get_result();
	            $out = array();
		        while ($row = $result->fetch_assoc()) $out[] = $row;
		        return $out;
	        }
	        return null;
	        // ^ If none of the above types match, then probable that query is wrong and thus return null
	    }
	};
}

?>