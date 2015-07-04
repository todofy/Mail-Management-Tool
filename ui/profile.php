<?php
if (!isset($_CODE_PROFILE)) {
    throw new Exception("Code file not included for profile.php!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="./js/jquery1.7.2.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" href="css/jAlert-v3.css" />
</head>

<body>

	<?php
	include __DIR__ .'/header.php';
	include __DIR__ .'/sidebar.php';
	?>

	<!-- Main workspace starts from here -->
	<div id="content-wrapper">
		<div class="row">
			<ol class="breadcrumb">
			    <li><a href="./dashboard.php">Home</a></li>
			    <li class="active">Profile</li>
			</ol>
			<div class="col-md-7">
				<h3>Change password</h3>
				<form role="form" id="change_pw" type="post">
  					<div class="form-group">
    					<label for="current"><h4>Current password:</h4></label>
    					<input type="password" class="form-control" id="current_pw" name="current_pw" style="width: 50%; min-width: 200px">
    				<div class="form-group">
    					<label for="new"><h4>New password:</h4></label>
    					<input type="password" class="form-control" id="new_pw" name="new_pw" style="width: 50%; min-width: 200px">
  					</div>
  					<div class="form-group">
    					<label for="confirm"><h4>Confirm password:</h4></label>
    					<input type="password" class="form-control" id="confirm_pw" name="confirm_pw" style="width: 50%; min-width: 200px">
  					</div>
  					</div>
  					<button type="submit" class="btn btn-primary" value="Submit" id="btn">Done</button>  					
				</form>					
			</div>
			<div class="col-md-4 pull-right">
				
			</div>
		</div>
		
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/profile.js"></script>
</body>
</html>