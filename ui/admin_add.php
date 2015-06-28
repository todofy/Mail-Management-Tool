<?php
if (!isset($_ADMIN_ADD_)) {
    throw new Exception("Code file not included for admin_add.php!");
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
			    <li class="active">Add Admin</li>
			</ol>
			<div class="col-md-7">
				<h3>Add an admin</h3>
				<form role="form" id="add" type="post">
  					<div class="form-group">
    					<label for="email"><h4>Email address:</h4></label>
    					<input type="email" class="form-control" name="email" placeholder="someone@dmain.com" style="width: 50%; min-width: 200px">
  					</div>
  					<h4 class="control-label">Access rights:</h4>
  					<div class="form-group">
  						<?php
  							foreach ($accesses as $value) {
  								echo '<div>';
  								echo '<input type="checkbox" name="access[]" value="' .$value['id'] .'">';
  								echo ' <strong style="text-transform: uppercase">' .$value['name'] .'</strong>: &nbsp; ' .$value['description'];
  								echo '</div>';
  							}
  						?>
  					</div>

  					<div class="clearfix"></div>
  					<div class="bs-callout bs-callout-info">
  						<h4>Note</h4>
  						A password will be automatically generated for this admin and would be sent to the
  						email id. All other information like API key (if admin has access) and access would also be 
  						sent along with the mail.
  					</div>
  					
  					<button type="submit" class="btn btn-default" value="Submit" id="btn">Add</button>
				</form>					
			</div>
			<div class="col-md-4 pull-right">
				
			</div>
		</div>
		
	</div>

</body>
<script src="js/main.js"></script>
<script src="js/admin_add.js"></script>
</html>