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
  // to avoid mutiple redefinations
  $_DEF_USER_ = true;

  class user
  {
      private  $password;
      public  $email;
      private  $remember;

      function toremember() {
        return $this->remember;
      }

      private function get_pw() {
        return $this->password;
      }

      function set_initial($email_id, $pw) {
        $this->email = $email_id;
        $this->password = $pw;
      }

      function __construct() {
        $this->remember= false ;
      }

      function pushToDB() {
          //used in sign up
          if(!isset($this->w_stmt)) {
              $this->w_stmt = database::SQL("INSERT INTO admin (email,password) VALUES (?, ?)", array('ss', $this->email, $this->password));
          }
         return true;
      }
      function checkFromDB()
      {
          //used in login
          if (database::$con == NULL) database::Start();

          if(!isset($this->read_stmt)) {
            return database::SQL("SELECT id FROM admin WHERE email = ? AND password= ? LIMIT 1", array('ss', $this->email, $this->password));
         }

         return null;
      }
  }

}
?>