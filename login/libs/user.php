<?php
class user
{
  private  $password;
  public  $email;
  private  $remember;
  function toremember()
  {
    return $this->remember;
  }
  private function get_pw()
  {
    return $this->password;
  }
  function set_initial($email_id,$pw)
  {
    $this->email=$email_id;
    $this->password=$pw;
  }
  function __construct()
  {
    //echo "hiii";
    $this->remember= false ;
  }
  function pushToDB()
  {
      //used in sign up
    if(!isset($this->w_stmt)) {
      $this->w_stmt = $this->db->prepare("INSERT INTO admin (email,password) VALUES (?, ?)");
   }
 
   $this->w_stmt->bind_param('ss', $this->email,$this->password);
   $this->w_stmt->execute();
   return true;
  }
  function checkFromDB()
  {
    //used in login
    $this->open();
    if(!isset($this->read_stmt)) {
      $this->read_stmt = $this->db->prepare("SELECT id FROM admin WHERE email = ? AND password= ? LIMIT 1");
   }
   echo $this->password;
   echo $this->email;
   $this->read_stmt->bind_param('ss', $this->email,$this->password);
   $this->read_stmt->execute();
   $this->read_stmt->store_result();
   $this->read_stmt->bind_result($data);
   if(!$this->read_stmt->fetch())
   {
    $data=false;
   }
   $this->read_stmt->free_result();
   $this->read_stmt->close();
   return $data;
  }

  private function open()
  {
    $host = 'localhost';
   $user = 'root';
   $pass = 'ashish15';
   $name = 'MMT';
   $mysqli = new mysqli($host, $user, $pass, $name);
   $this->db = $mysqli;
  } 
}
?>