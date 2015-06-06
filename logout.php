<?php
	session_start();
	$SECURE = true;
	
	require "libs/globals.php";
	require "libs/session.php";
	session::destruct();
	redirect_to("index.php");
?>