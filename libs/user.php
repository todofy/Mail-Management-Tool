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
      private  $password;    //stores the password of the user
      public  $email;        //stores the email of the user
      private  $remember;    //stores whether or not to remember the user

      //returns the state of the object whether to be remembered or not
      function toremember() {
        return $this->remember;
      }
      
      //returns the password for the current user
      //not required yet may be removed
      private function get_pw() {
        return $this->password;
      }

      //sets the initial values for the email and the password
      function set_initial($email_id, $pw) {
        $this->email = $email_id;
        $this->password = $pw;
      }

      //the constructor method: set new users remembered me to false which is true only when user selects the remember me
      function __construct() {
        $this->remember= false ;
      }

      //pushes the user's info into the database
      function pushToDB() {
          //used in sign up
          if(!isset($this->w_stmt)) {
              $this->w_stmt = database::SQL("INSERT INTO admin (email,password) VALUES (?, ?)", array('ss', $this->email, $this->password));
          }
         return true;
      }

      //gets the id of the current user object (if found) otherwise returns null
      function checkFromDB()
      {
          //used in login
          if (database::$con == NULL) database::Start();

          if(!isset($this->read_stmt)) {
            $result = database::SQL("SELECT id FROM admin WHERE email = ? AND password= ? LIMIT 1", array('ss', $this->email, $this->password));
            //$row=$result->fetch_array(MYSQLI_ASSOC);
            if(isset($result))
            {
              return $result[0]['id'];
            }
            //return $row['id'];
         }

         return null;
      }
  }

}
?>