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
</head>

<body>

	<?php
	include __DIR__ .'/header.php';
	include __DIR__ .'/sidebar.php';
	?>

	<!-- Main workspace starts from here -->
	<div id="content-wrapper">
		<div class="row">
			<div class="col-md-7">
				<h3>Add an admin</h3>
				<form role="form" enctype="application/json" action="test.json" method="post">
  					<div class="form-group">
    					<label for="email">Email address:</label>
    					<input type="email" class="form-control" name="email">
  					</div>
  					<label class="control-label">Access rights:</label>
  					<div class="form-group">
  						<label class="checkbox-inline"><input type="checkbox" name="access" value="1">Admin View</label>
						<label class="checkbox-inline"><input type="checkbox" name="access" value="2">Admin Add</label>
						<label class="checkbox-inline"><input type="checkbox" name="access" value="3">Admin Edit</label>
						<label class="checkbox-inline"><input type="checkbox" name="access" value="4">Admin Revoke</label>
						<label class="checkbox-inline"><input type="checkbox" name="access" value="5">Admin Delete</label>
  					</div>
  					
  					<button type="submit" class="btn btn-default" value="Create">Add</button>
				</form>					
			</div>
			<div class="col-md-4 pull-right">
				<p class="text-justify">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac libero eros. Proin aliquet lacinia lorem accumsan vehicula. Suspendisse potenti. Sed laoreet ullamcorper tortor eu faucibus. Aenean eu mi laoreet, porttitor neque et, placerat dui. Donec sit amet maximus nisl. Quisque vulputate augue ac lorem lacinia vestibulum. Proin erat nibh, mollis ac turpis quis, sollicitudin feugiat ligula. Aliquam eu turpis metus. In est purus, scelerisque sit amet vestibulum quis, aliquam ac eros.

					Donec et urna eget massa rhoncus pharetra. Maecenas id dapibus mi, a scelerisque magna. Phasellus aliquet auctor nulla sed dapibus. Praesent sed nibh in dolor consectetur eleifend. Ut finibus purus eu purus sodales tempor. Suspendisse id fringilla enim. Vestibulum sit amet nunc sit amet arcu vestibulum interdum non eu elit. Praesent varius felis eu eleifend commodo.

					Nunc dolor ex, elementum eget tincidunt sit amet, porta ac justo. Donec et purus at augue tristique pellentesque ut sed mi. Sed et erat vitae odio ultrices gravida et eget leo. Maecenas ante elit, dictum ut fermentum posuere, semper et risus. Etiam viverra maximus tortor, sollicitudin consectetur elit eleifend in. Ut nec augue lobortis, facilisis tellus et, dictum eros. Mauris pretium libero ac diam placerat, posuere varius lacus gravida.
				</p>	
			</div>
		</div>
		
	</div>

</body>
</html>