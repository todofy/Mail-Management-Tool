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
    $_DEF_LOGIN_ = true;

    class login
    {
        /**
         * Function to check if login is possible for
         * username and password pair, if yes set session
         * for that login and return true, else return false
         */
        public static function login_user($email, $password, $rememberMe = false) {
            if (!self::verifyEmail($email)) return false;

            $hashedPw = self::hashPassword($password);
            //$result = database::SQL("UPDATE admin set temp = ?  WHERE email = ? ",array('ss',$hashedPw,$email));
            $result = database::SQL("SELECT id FROM admin WHERE email = ? AND password= ? LIMIT 1", array('ss', $email, $hashedPw));
            if(!empty($result)) {
                $id = $result[0]['id'];
                //set the session
                session::Set($id);
                if ($rememberMe) self::setCookieToRemember();
                return true;
            }
            return false;
        }

        public static function hashPassword($password) {
            return md5(SALT .($password));
        }

        public static function setCookieToRemember() {
            $id = $_SESSION['user_id'];
            $randStr = self::getHash(32);
            // save the hash in the database
            //save other things like time and all if needed
            $result = database::SQL("UPDATE admin set cookie=? where id=?",array('ss',$randStr,$id));
            //save the cookie for 1 month
            setcookie(REMEMBER_ME_COOKIE, $randStr, time() + 30*24*60*60);
        }

        /**
         * Function reads the random string in cookie, mathches it with an entry in db
         * if true, sets the session & return true
         * else delete the cookie, return false
         */
        public static function verifyCookieToRemember() {
            if (!isset($_COOKIE[REMEMBER_ME_COOKIE])) return false;
            
            //validate the cookie from the database
            $cookie = $_COOKIE[REMEMBER_ME_COOKIE];
            $result = database::SQL("SELECT `id` FROM `admin` WHERE `cookie`=?",array('s',$cookie));
            if(!empty($result)) {
                // will automatically login the user
                    session::Set($result[0]['id']);
                    return true;
                // @this was wrong as it sets the cookie again and checks for a hashed password which is already hashed:   return self::login_user($result[0]['email'], $result[0]['password'], true);
            }
            return false;
        }

        public static function getHash($length = 16) {
            /* Use `openssl_random_psuedo_bytes` if available; PHP5 >= 5.3.0 */
            if (function_exists("openssl_random_pseudo_bytes")) {
                return substr(bin2hex(openssl_random_pseudo_bytes($length)), 0, $length);
            }
            /* Fall back to `mcrypt_create_iv`; PHP4, PHP5 */
            if (function_exists('mcrypt_create_iv')) {
                return substr(bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM)), 0, $length);
            }
            
            $sha = '';
            $rnd = '';
            for ($i = 0; $i < $length; $i++) {
                $sha = hash('sha256', $sha.mt_rand());
                $char = mt_rand(0,62);
                $rnd .= $sha[$char];
            }
            return $rnd;
        }

        //function to verify the email address
        public static function verifyEmail($email) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
            if(preg_match($regex, $email)) return true;
            return false;
        }
    };

  
}
