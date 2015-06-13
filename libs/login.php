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

if (!isset($_DEF_LOGIN_)) {
    // to avoid mutiple redefinations
    $_DEF_USER_ = true;

    class login
    {

        /**
         * Function to check if login is possible for
         * username and password pair, if yes set session
         * for that login and return true, else return false
         */
        public static login($email, $password, $rememberMe = false) {
            // #todo - implement this and remember to hash the password,
            // before verefication

            $password = self::hashPassword($password);
            // #todo - implement the login functionality here,
            // Verify the username and password hash
            // if fails return false
            // else set session, remember setCookieToRemember() relies on session

            if ($rememberMe) {
                self::setCookieToRemember();
            }
        }

        public static hashPassword($password) {
            // #todo - use a appropriate hashing algorithm, do write the
            // documentation for this
        }

        public static setCookieToRemember() {
            // #todo - generate a random string, and save a database entry for this
            // user id as in session
            $randStr = self::getHash();
        }

        /**
         * Function reads the random string in cookie, mathches it with an entry in db
         * if true, sets the session & return true
         * else delete the cookie, return false
         */
        public static verifyCookieToRemember() {

        }

        public static getHash($length = 16) {
            /* Use `openssl_random_psuedo_bytes` if available; PHP5 >= 5.3.0 */
            if (function_exists("openssl_random_pseudo_bytes")) {
                return substr(bin2hex(openssl_random_pseudo_bytes($length)), 0, $length);
            }
            /* Fall back to `mcrypt_create_iv`; PHP4, PHP5 */
            if (function_exists('mcrypt_create_iv')) {
                return substr(bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM)), 0, $length);
            }
            $sha = ''; $rnd = '';
            for ($i = 0; $i < $length; $i++)
            {
                $sha = hash('sha256', $sha.mt_rand());
                $char = mt_rand(0,62);
                $rnd .= $sha[$char];
            }
            return $rnd;
        }
    };

  
}