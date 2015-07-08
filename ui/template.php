<?php
if (!isset($_CODE_TEMPLATE)) {
    throw new Exception("Code file not included for template.php!");
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
			    <li class="active">Template</li>
			</ol>
		</div>
		<div class="row">
		    <div class="col-md-9">
		    	<h3>View Templates</h3>
		    </div>
		    <div class="col-md-3">
				<a href="template_add.php" type="button" class="btn btn-success pull-right">Add</a>
			</div>
		</div>
		<div class="row">
			<table class="table">
				<tr>
					<th>#ID</th>
					<th>Name</th>
					<th>Created On</th>
					<th>Last Updated</th>
					<th>Actions</th>
				</tr>
				<?php
					foreach ($templates as $value) {
						echo '<tr>';
						echo '<td>' .$value['id'] .'</td>';
						echo '<td>' .$value['name'] .'</td>';
						echo '<td>' .date("D, d M 20y", $value['created_on']) .'</td>';
						echo '<td>' .date("D, d M 20y", $value['last_updated']) .'</td>';
						echo '<td>';
							$edit = "template_edit.php?id=".$value['id'];
							echo '<a class="btn btn-primary button-edit" href='.$edit.' role="button" id='.$value['id'].'>Edit</a> ';
							echo '<a class="btn btn-danger button-delete" href="#" role="button" data-toggle="modal" data-target="#delete" id='.$value['id'].'>Delete</a> ';
						echo '</td>';
						echo '</tr>';
					}
				?>
			</table>
		</div>
		<div id="delete" class="modal fade" role="dialog" style="z-index: 15000; margin-top:100px;">
  			<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header">
        				<h4 class="modal-title">Delete Template</h4>
      				</div>
      				<div class="modal-body">
        				<p>Are you sure you want to delete this template?</p>
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
<script src="js/main.js"></script>
<script src="js/template.js"></script>
</body>
</html>