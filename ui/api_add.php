<?php
if (!isset($_API_ADD_)) {
    throw new Exception("Code file not included for api_add.php!");
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
	<script src="./js/jquery-2.0.0.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
			    <li><a href="template.php">API</a></li>
			    <li class="active">Add</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Create API</h3>
				<form role="form" type="post" id="create-api">
					<div class="form-group">
	    				<label for="template-name"><h4>API Name</h4></label>
	    				<input type="text" class="form-control" id="api-name" name="api-name" style="width: 40%; min-width: 200px">
	  				</div>
	  				<div class="form-group">
	  					<label class="control-label"><h4>Select Template</h4></label>
	  					<select class="form-control" name="template" style="width:auto; display:inline-block; margin-left: 10px;">
	    					<?php
	    						foreach ($templates as $value) {
	    							echo '<option>'.$value['name'].'</option>';
	    						}
	    					?>
	  					</select>
	  					<a href="template_add.php" type="button" class="btn btn-link">Create a new Template</a>
					</div>
				</form>
	  			<button type="submit" class="btn btn-success" value="Submit" id="save">Save</button>
	  		</div>
		</div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/api_add.js"></script>
</body>
</html>