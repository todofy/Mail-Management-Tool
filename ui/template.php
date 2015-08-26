<?php
if (!isset($_CODE_TEMPLATE_)) {
    throw new Exception("Code file not included for template.php!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

	<div class="row" id="container">
		<?php
		include __DIR__ .'/header.php';
		include __DIR__ .'/sidebar.php';
		?>

		<!-- Main workspace starts from here -->
		<div id="content-wrapper"  class="col-xs-10 col-xs-offset-2">
			<div class="col-xs-12">
				<ol class="breadcrumb">
				    <li><a href="dashboard.php">Home</a></li>
				    <li class="active">Template</li>
				</ol>
			</div>
		    <div class="col-xs-9">
		    	<h3>List of all Templates</h3>
		    </div>
		    <div class="col-xs-3">
				<a href="template_add.php" type="button" class="btn btn-success" style="float:right; margin-right: 10px;">Add</a>
			</div>
			<?php
			if(empty($templates))
				echo '
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
						<div class="alert alert-info" style="text-align: center;">No templates created yet.<a href="template_add.php"> Create a new template.</a></div>
					</div>';
			else{
				echo '
					<div class="col-xs-12">
						<table class="table">
							<tr style="background-color: #E0E0E0;">
								<th class="col-xs-1"><center>#ID</center></th>
								<th class="col-xs-2">Name</th>
								<th class="col-xs-1"><center>Parameters</center></th>
								<th class="col-xs-1"><center>Links</center></th>
								<th class="col-xs-2"><center>Created On</center></th>
								<th class="col-xs-2"><center>Last Updated</center></th>
								<th class="col-xs-3" style="text-align:right;">Actions</th>
							</tr>';
							foreach ($templates as $value) {
								echo '<tr>';
								echo '<td><center>' .$value['id'] .'</center></td>';
								echo '<td>' .$value['name'] .'</td>';
								echo '<td><center>'.$value['parameters'].'</center></td>';
								echo '<td><center>'.$value['links'].'</center></td>';
								echo '<td><center>' .date("D, d M 20y", $value['created_on']).'<br>'.date("h:i:s A (e)", $value['created_on']).'</center></td>';
								echo '<td><center>' .date("D, d M 20y", $value['last_updated']).'<br>'.date("h:i:s A (e)", $value['last_updated']).'</center></td>';
								echo '<td style="text-align:right;">';
									echo '<a class="btn btn-info button-view" href="#" role="button" data-toggle="modal" data-target="#preview" id='.$value['id'].'>View</a> ';
									$edit = "template_edit.php?id=".$value['id'];
									echo '<a class="btn btn-primary button-edit" href='.$edit.' role="button" id='.$value['id'].'>Edit</a> ';
									echo '<a class="btn btn-danger button-delete" href="#" role="button" data-toggle="modal" data-target="#delete" id='.$value['id'].'>Delete</a> ';
								echo '</td>';
								echo '</tr>';
							}
						echo '</table>
					</div>';
				}
			?>
		</div>
		<div class="col-xs-12">
			<div id="preview" class="modal fade" role="dialog" style="z-index: 15000; margin-top:40px;">
	  			<div class="modal-dialog" style="margin:auto; width: 90%; overflow-y: initial;">
	    			<div class="modal-content">
	    				<div class="modal-header">
	        				<h4 class="modal-title">Preview Template</h4>
	      				</div>
	      				<div class="modal-body" style="overflow-y: auto;">
	      					<div class="well" id="template-preview" ></div>
	      				</div>
	  					<div class="modal-footer" style="margin-top: -20px;">
	      					<a class="btn btn-primary button-edit-secondary" href='#' role="button">Edit</a>
	        				<button type="button" class="btn btn-link" data-dismiss="modal">Back</button>
	        			</div>
	    			</div>
	  			</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div id="delete" class="modal fade" role="dialog" style="z-index: 15000; top:20%; left:10%;">
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
	</div>
	<div class="row"  id="warning-message">
		<div class="col-xs-12">
			<div class="well">
				<h2>Please switch to landscape mode.</h2>
			</div>
		</div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/template.js"></script>
</body>
</html>