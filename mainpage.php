<?php
session_start();
$SECURE = true;
require "libs/session.php";

echo "reaached mainpage  ";
if(isset($_SESSION['user_id'])) {
	echo "set";
	echo "<a href='logout.php'>Logout</a>";
}
else
echo "not set"; 
?>