<?php
if (!isset($_CODE_API_)) {
    throw new Exception("Code file not included for api.php!");
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
			    <li><a href="dashboard.php">Home</a></li>
			    <li class="active">API</li>
			</ol>
		</div>
		<div class="row">
		    <div class="col-md-9">
		    	<h3>List of all APIs</h3>
		    </div>
		    <div class="col-md-3">
				<a href="api_add.php" type="button" class="btn btn-success pull-right">Add</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<tr>
<<<<<<< HEAD
						<th class="col-md-2">#ID</th>
						<th class="col-md-3">Code</th>
						<th class="col-md-4">Created On</th>
						<th class="col-md-3">Actions</th>
=======
						<th>#ID</th>
						<th>Code</th>
						<th>Created On</th>
						<th>Actions</th>
>>>>>>> origin/master
					</tr>
					<?php
						foreach ($apis as $value) {
							echo '<tr>';
							echo '<td>' .$value['id'] .'</td>';
							echo '<td>' .$value['code'] .'</td>';
							echo '<td>' .date("D, d M 20y", $value['created_on']) .'</td>';
							echo '<td>';
								$view = "api_view.php?id=".$value['id'];
								echo '<a class="btn btn-info button-view" href='.$view.' role="button" id='.$value['id'].'>View</a> ';
								$edit = "api_edit.php?id=".$value['id'];
								echo '<a class="btn btn-primary button-edit" href='.$edit.' role="button" id='.$value['id'].'>Edit</a> ';
								echo '<a class="btn btn-danger button-delete" href="#" role="button" data-toggle="modal" data-target="#delete" id='.$value['id'].'>Delete</a> ';
							echo '</td>';
							echo '</tr>';
						}
					?>
				</table>
			</div>
		</div>
		<div id="delete" class="modal fade" role="dialog" style="z-index: 15000; margin-top:100px;">
  			<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header">
        				<h4 class="modal-title">Delete API</h4>
      				</div>
      				<div class="modal-body">
        				<p>Are you sure you want to delete this API?</p>
        				<br>
        				<button type="button" class="btn btn-danger button-delete-confirm" data-dismiss="modal">Delete</button>
        				<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        			</div>
    			</div>
  			</div>
		</div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
</body>
</html>