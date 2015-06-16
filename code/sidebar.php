<?php
require "libs/database.php";
require "libs/user.php";
// to get the access ids of the current set admin
  $id=$_SESSION['user_id'];
  $newuser= new user($id);
?>