<?php
session_start();
require "libs/session.php";
require "includes/functions.php";
echo "reaached mainpage  ";
if(isset($_SESSION['user_id']))
{
	echo "set";
	echo "<a href='logout.php'>Logout</a>";
}
else
echo "not set"; 
?>