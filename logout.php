<?php
	session_start();
	$SECURE = true;
	
	require "libs/globals.php";
	require "libs/session.php";
	session::destruct();
	//remove the cookie
	if(isset($_COOKIE['remember']))
	{
		//delete the cookie
		setcookie('remember',null,time()-100);
		// remove the entry from the database if u want
	}
	redirect_to("index.php");
?>