<?php
session_start();
$SECURE=true;
require "libs/database.php";
// to get the access ids of the current set admin
if(!isset($_SESSION['user_id']))
{
	echo "access denied: no admin found";
}
else
{
	$id=$_SESSION['user_id'];
	//change the query such that the array has all the access names stored rather than their ids
	$result = database::SQL("SELECT access_id from admin_access where admin_id=?",array('i',$id));
	if(isset($result))
	{
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			echo "{$row['access_id']} ";
		} 
	}
}
?>