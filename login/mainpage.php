<?php
session_start();
require "libs/session.php";
require "includes/functions.php";
echo "reaached mainpage  ";
if(isset($_SESSION['user_id']))
{
	echo "set";
	session::destruct();
	redirect_to("mainpage.php");
}
else
echo "not set"; 
?>