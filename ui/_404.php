<?php
if (!isset($_CODE_404_)) {
    throw new Exception("Code file not included for _404.php!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Todofy</title>
    <link rel="icon" href="assets/icon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-2.0.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/jAlert-v3.css" />
	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/content.css" type="text/css">
	<link rel="stylesheet" href="css/custom.css" type="text/css">
</head>

<body>
	<div class="row">

		<div  id="header" class="col-xs-12 header-user-dropdown">
			<div class="row header-limiter">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
				<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2" id="logo-container">
					<img id="logo" src="assets/logo.png">
				</div>
				<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9"></div>
			</div>
		</div>
		
		<div id="content-wrapper" class="col-xs-12">
			<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2" style="margin-top: 5%;">
				<div class="alert alert-danger">
					<h3>ERROR 404!</h3>
					<h4>Either you don't have access or you followed an invalid link.</h4>
				</div>
				<div class="col-xs-12"><a href="dashboard.php"><h4>Home</h4></a></div>
			</div>
		</div>
	</div> 
</body>
</html>