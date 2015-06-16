<?php
session_start();
$SECURE=true;
require "../libs/session.php";
?>

<html>
	<head>
        <meta charset="UTF-8">
        <title>Dashboard Demo</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script> 
			/*$(function(){
  				$("#header").load("header.html");
  				$("#sidebar").load("sidebar.php");  
			});*/
		</script>
	</head>
	<body>
		<div id="header">
			<?php include "header.html" ?>
		</div>
        <div id="sidebar">
        	<?php include "sidebar.php" ?>
        </div>
	</body>
</html>
